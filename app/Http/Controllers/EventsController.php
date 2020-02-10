<?php

namespace App\Http\Controllers;

use App\Business\EventsBusiness;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    private $eventsBusiness;

    public function __construct(EventsBusiness $eventsBusiness)
    {
        $this->eventsBusiness = $eventsBusiness;
    }

    public function index()
    {
        $todayEvents = $this->eventsBusiness->getTodayEvents();
        $fiveDayEvents = $this->eventsBusiness->getFiveDayEvents();
        $paginatedEvents = $this->eventsBusiness->getAllPaginated();
        return view('events.eventsView')
            ->with('fiveDayEvents', $fiveDayEvents)
            ->with('todayEvents', $todayEvents)
            ->with('paginatedEvents', $paginatedEvents);
    }

    public function create()
    {
        return view('events.eventsForm');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        return $this->eventsBusiness->create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Events  $events
     * @return \Illuminate\Http\Response
     */
    public function show(Events $events)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Events  $events
     * @return \Illuminate\Http\Response
     */
    public function edit(Events $events)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Events  $events
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Events $events)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Events  $events
     * @return \Illuminate\Http\Response
     */
    public function destroy(Events $events)
    {
        //
    }
}
