<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Exception;
use Illuminate\Http\Response;
use App\Http\Requests\Event as EventRequest;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param EventRequest $request
     * @return Response
     */
    public function store(EventRequest $request)
    {
        try {
            $event = Event::create($request->only('title', 'description', 'start', 'end'));
            return redirect()->route('event.edit', $event)->with('success', 'Event created successfully');
        } catch (Exception $e) {
            return redirect()->back()->withErrors('Error creating an event, please try again.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Event $event
     * @return Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Event $event
     * @return Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Event $event
     * @return Response
     */
    public function destroy(Event $event)
    {
        //
    }
}
