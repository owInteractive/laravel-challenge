<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::all();
        return view('event.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('event.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $event = new Event([
          'title' => $request->get('title'),
          'description' => $request->get('description'),
          'date_time_start'=> $request->get('date_time_start'),
          'date_time_end'=> $request->get('date_time_end')
        ]);
        $event->save();
        return redirect('/event')->with('success', 'Event has been added');
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
        $event = Event::find($id);

        return view('event.edit', compact('event'));
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
        $request->validate([
          'event_name'=>'required',
          'event_price'=> 'required|integer',
          'event_qty' => 'required|integer'
        ]);
  
        $event = Event::find($id);
        $event->event_name = $request->get('event_name');
        $event->event_price = $request->get('event_price');
        $event->event_qty = $request->get('event_qty');
        $event->save();
  
        return redirect('/event')->with('success', 'Event has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::find($id);
        $event->delete();
   
        return redirect('/event')->with('success', 'Event has been deleted Successfully');
    }
}
