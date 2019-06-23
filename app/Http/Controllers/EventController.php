<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\Event as EventRequest;

class EventController extends Controller
{
    /**
     * @param string|null $filter
     * @return Event[]|null
     */
    private function eventsByFilter($filter)
    {
        /** @var User $user */
        $user = auth()->user();

        $eventBuilder = $user->events();

        if ($filter === 'today') {
            $eventBuilder->today();
        }

        if ($filter === 'next-five-days') {
            $eventBuilder->nextFiveDays();
        }

        return $eventBuilder->get();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $events = $this->eventsByFilter(
            request()->get('filter')
        );
        return view('event.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('event.create');
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
            $event = Event::create(
                $request->only('title', 'description', 'start', 'end')
            );
            return redirect()->route('event.edit', $event)->with('success', 'Event created successfully');
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withErrors('Error creating an event, please try again.')
                ->withInput();
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
        return view('event.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EventRequest $request
     * @param Event $event
     * @return Response
     */
    public function update(EventRequest $request, Event $event)
    {
        try {
            $event->update(
                $request->only('title', 'description', 'start', 'end')
            );
            return redirect()->back()->with('success', 'Event updated successfully');
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withErrors('Error updated an event, please try again.')
                ->withInput();
        }
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
