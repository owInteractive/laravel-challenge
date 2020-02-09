<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::where('user_id', \Auth::user()->id)->paginate(3);
        // $img = Storage::get('/public/party-1.jpg');
        // $img = base64_encode($img);
        
        
        // $data = [
        //     'events'    => $events,
        //     'image'     => $img
        // ];
        return view('events.index')->with('events', $events);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // If the start date is equal than the finish date, the finish time must be greater than the start time
        $rule_finish_time = ($request->input('start_date') == $request->input('finish_date')) ? '|after:start_time' : '';
        // Custom rule
        $rule = [
            'title' => 'required',
            'description' => 'required',
            'start_date' => 'date_format:Y-m-d|after:yesterday',
            'start_time' => 'date_format:H:i|after:now',
            'finish_date' => 'date_format:Y-m-d|after_or_equal:start_time',
            'finish_time' => 'date_format:H:i' . $rule_finish_time
        ];
        // Validating
        $this->validate($request, $rule);
        // Creating new event
        $event = new Event();
        $event->user_id = \Auth::user()->id;
        $event->title = $request->input('title');
        $event->description = $request->input('description');
        $event->start_date = "{$request->input('start_date')} {$request->input('start_time')}:00";
        $event->finish_date = "{$request->input('finish_date')} {$request->input('finish_time')}:00";
        $event->public = 1;
        // Applying
        return response()->json($event->save());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }
}
