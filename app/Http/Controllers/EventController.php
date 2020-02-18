<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EventController extends Controller
{

    protected $eventModel;

    public function __construct(Event $eventModel)
    {
        $this->eventModel = $eventModel;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filtersQuery[] = ['user_id', \Auth::user()->id];
        $filter = [];

        if (request('q')) {
            $filter = ['q' => request('q')];
            switch (request('q')) {
                case 'next':
                    $filtersQuery[] = ['start_at', '<', \Carbon\Carbon::today()->addDays(5) ];
                    $filtersQuery[] = ['end_at', '>=', \Carbon\Carbon::today()];
                    break;
                case 'today':
                    $filtersQuery[] = ['start_at', '<', \Carbon\Carbon::today()->addDays(1) ];
                    $filtersQuery[] = ['end_at', '>=', \Carbon\Carbon::today()];
                    break;
            }
        }

        $events = $this->eventModel->where($filtersQuery)->paginate(10);
        return view('events.index', compact('events', 'filter'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'start_at' => 'required',
            'end_at' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                        ->route()
                        ->withErrors($validator)
                        ->withInput();
        }

        $input = $request->all();
        $input->user_id = \Auth::user()->id;
        $event = $this->eventModel->create($input);
        session()->flash('success', 'Event created!');
        return redirect()->route('events.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $event = $this->eventModel->findOrFail($id);
        } catch (ModelNotFoundException $ex) {
            session()->flash('error', 'Event not found!');
            return redirect()->route('events.index');
        }

        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $event = $this->eventModel->findOrFail($id);
        } catch (ModelNotFoundException $ex) {
            session()->flash('error', 'Event not found!');
            return redirect()->route('events.index');
        }

        $validator = \Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'start_at' => 'required',
            'end_at' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $event->fill($request->except('id'));
        $event->save();
        session()->flash('success', 'Event updated!');
        return redirect()->route('events.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $event = $this->eventModel->findOrFail($id);
        } catch (ModelNotFoundException $ex) {
            session()->flash('error', 'Event not found!');
            return redirect()->route('events.index');
        }

        $event->delete();
        session()->flash('success', 'Event deleted!');
        return redirect()->route('events.index');
    }
}
