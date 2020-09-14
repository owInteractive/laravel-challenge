<?php

namespace App\Http\Controllers;

use App\Event;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::where('user_id', Auth::id())->paginate(5);

        return view('events.index',compact('events'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *e
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userId = Auth::id();
        return view('events.create', compact('userId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'start' => 'required',
            'end' => 'required',
            'user_id' => 'required'
        ]);

        Event::create($request->all());

        return redirect()->route('events.index')
            ->with('success','Event created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        $userName = User::find($event->user_id)->name;
        return view('events.show',compact('event', 'userName'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('events.edit',compact('event'));
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

        $request->validate([
            'title' => 'required',
            'name' => 'required',
            'description' => 'required',
            'start' => 'required',
            'end' => 'required',
        ]);

        $event->update($request->all());

        return redirect()->route('events.index')
            ->with('success','Event updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events.index')
            ->with('success','Event deleted successfully');
    }


    public function todayEvents() {
        $start = Carbon::now()->setTimezone('GMT-3')->startOfDay();
        $end = Carbon::now()->setTimezone('GMT-3')->endOfDay();

        $events = Event::where('user_id', Auth::id())->whereBetween('start', [$start, $end])->whereBetween('end', [$start, $end])->paginate(5);;
        return view('events.today',compact('events'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function nextFiveDaysEvents() {
        $start = Carbon::now()->setTimezone('GMT-3')->startOfDay();
        $end = Carbon::now()->addDays(5)->setTimezone('GMT-3')->endOfDay();

        $events = Event::where('user_id', Auth::id())->whereBetween('start', [$start, $end])->whereBetween('end', [$start, $end])->paginate(5);;
        return view('events.nextFiveDays',compact('events'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
}
