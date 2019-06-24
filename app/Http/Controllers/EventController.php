<?php

namespace App\Http\Controllers;

use App\Events\EventInvitation;
use App\Models\Event;
use App\Models\Guest;
use Exception;
use Illuminate\Http\Request;
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
        $events = Event::currentUser()->eventsByFilter(
            request()->get('filter')
        )->get();
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

    public function show(Event $event)
    {
        return view('event.show', compact('event'));
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
        try {
            $event->delete();
            return redirect()->back();
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withErrors('Error deleted an event, please try again.');
        }
    }

    public function invitationForm(Event $event)
    {
        return view('event.invitation', compact('event'));
    }

    public function invitation(Request $request, Event $event)
    {
        $this->validate($request, [
            'emails' => 'required',
        ]);

        try {
            $emails = array_map('trim', explode(',', $request->get('emails')));

            foreach ($emails as $email) {
                /** @var Guest $guest */
                $guest = $event->guests()->create(compact('email'));
                event(new EventInvitation($guest));
            }

            return redirect()
                ->back()
                ->with('success', 'Invited guests successfully.');
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withErrors('Error deleted an event, please try again.');
        }
    }
}
