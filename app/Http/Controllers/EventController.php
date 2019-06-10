<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Http\Requests\ImportEventsRequest;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('events.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param EventRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
    {
        auth()->user()->events()->create($request->all());

        return redirect()->back()->with('success', 'Event was created!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EventRequest $request
     * @param \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function update(EventRequest $request, Event $event)
    {
        $event->update($request->all());

        return redirect()->back()->with('success', 'Event was updated!');
    }

    /**
     * Method responsible for exporting events to csv files.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function export()
    {
        $events = Event::all();

        if ($events->count() > 0) {
            return Excel::create('Exported Events - ' . Carbon::now()->toDateTimeString(), function ($excel) use ($events) {
                $excel->sheet('Events', function ($sheet) use ($events) {

                    $sheet->fromArray($events->toArray());

                });
            })->download('csv');
        } else {
            return redirect()->back()->with('info', 'No items to export!');
        }
    }

    /**
     * Method responsible for returning the view to import events.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function import()
    {
        return view('events.import');
    }

    /**
     * Method responsible for importing events.
     *
     * @param ImportEventsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function importCsv(ImportEventsRequest $request)
    {
        $events = Excel::load($request->file('file')->getRealPath())->get();

        if ($events->count() > 0) {
            foreach ($events as $event) {
                $event = new Event([
                    'title' => $event->title,
                    'description' => $event->description,
                    'starts_at' => $event->starts_at,
                    'ends_in' => $event->ends_in,
                ]);

                auth()->user()->events()->save($event);
            }
        } else {
            return redirect()->back()->with('info', 'No items to import!');
        }

        return redirect()->back()->with('success', 'Import completed successfully!');
    }
}
