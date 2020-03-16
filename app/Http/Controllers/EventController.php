<?php

namespace App\Http\Controllers;

use App\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $userEvents = Event::where('user_id', Auth::user()->id);

        if($request->has('today') && $request->today) {
            $userEvents = $userEvents->whereDate('start_datetime', Carbon::today());
            $activeType = 'today';
        } else if($request->has('next5days') && $request->next5days) {
            $userEvents = $userEvents->whereBetween('start_datetime', [Carbon::today()->addDay(), Carbon::today()->addDays(5)]);
            $activeType = 'next5days';
        } else {
            $activeType = 'all';
        }

        $userEvents = $userEvents->orderBy('start_datetime');

        if($request->has('export') && $request->export) {
            $userEvents = $userEvents->get();

            return Excel::create('events-'.Carbon::today()->format('Y-m-d'), function($excel) use($userEvents) {
                $excel->sheet('Exported Events', function($sheet) use($userEvents) {
                    $sheet->fromArray($userEvents);
                });
            })->export('csv');
        } else {
            $userEvents = $userEvents->paginate(10);
        }

        return view('events.index', ['events' => $userEvents, 'activeType' => $activeType]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $type = ($request->has('import') && $request->import)?'import':'create';

        return view('events.create', ['type' => $type]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->type == 'create') {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'start_datetime' => 'required|date_format:Y-m-d\TH:i',
                'end_datetime' => 'required|date_format:Y-m-d\TH:i|after:start_datetime',
                'description' => 'required'
            ]);

            if ($validator->fails()) {
                return redirect('events/create')
                    ->withErrors($validator)
                    ->withInput();
            } else {
                Event::create([
                    'user_id' => Auth::user()->id,
                    'title' => $request->title,
                    'description' => $request->description,
                    'start_datetime' => Carbon::createFromFormat('Y-m-d\TH:i', $request->start_datetime),
                    'end_datetime' => Carbon::createFromFormat('Y-m-d\TH:i', $request->end_datetime)
                ]);

                Session::flash('message', 'Successfully created event!');
                return Redirect::to('events');
            }
        } elseif($request->type == 'import') {
            $validator = Validator::make($request->all(), [
                'file' => 'required'
            ]);

            $path = $request->file('file')->getRealPath();
            $data = Excel::load($path, function($reader) { })->get();

            if(!empty($data) && $data->count()) {
                foreach ($data->toArray() as $row) {
                    if(!empty($row)) {
                        $dataArray[] = [
                            'user_id' => Auth::user()->id,
                            'title' => $row['title'],
                            'start_datetime' => Carbon::createFromFormat('Y-m-d H:i', $row['start_datetime']),
                            'end_datetime' => Carbon::createFromFormat('Y-m-d H:i', $row['end_datetime']),
                            'description' => $row['description']
                        ];
                    }
                }

                if(!empty($dataArray)) {
                    foreach($dataArray as $importData) {
                        Event::create($importData);
                    }

                    Session::flash('message', 'Successfully imported event!');
                    return Redirect::to('events');
                }
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('events.edit', ['event' => $event]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'start_datetime' => 'required|date_format:Y-m-d\TH:i',
            'end_datetime' => 'required|date_format:Y-m-d\TH:i|after:start_datetime',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('events/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $event->fill([
                'title' => $request->title,
                'description' => $request->description,
                'start_datetime' => Carbon::createFromFormat('Y-m-d\TH:i', $request->start_datetime),
                'end_datetime' => Carbon::createFromFormat('Y-m-d\TH:i', $request->end_datetime)
            ]);
            $event->save();

            Session::flash('message', 'Successfully updated event!');
            return Redirect::to('events');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        if($event->user_id == Auth::user()->id) {
            $event->delete();

            Session::flash('message', 'Successfully destroyed event!');
            return Redirect::to('events');
        }
    }
}
