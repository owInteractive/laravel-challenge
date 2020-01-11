<?php

namespace App\Http\Controllers;

use App\Event;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventsController extends Controller
{

    public function index() {

        return view('events.index', [
            'events' => Event::getAllEventsPaginated(15),
        ]);

    }

    public function create()
    {
        return view('events.create');
    }

    public function show(int $id)
    {
        $event = Event::query()
            ->find($id);

        if (!is_a($event, Event::class)) {
            return redirect('/')
                ->withErrors('This event could not be found.');
        }

        return view('events.show', compact('event'));
    }

    public function store(Request $request)
    {
        $title = $request->title;
        $description = $request->description;
        $startAt = Carbon::parse($request->start)->toDateTimeString();
        $endAt = Carbon::parse($request->end)->toDateTimeString();

        /** @var Event $event */
        $event = Event::create([
            'title' => $title,
            'description' => $description,
            'start_at' => $startAt,
            'end_at' => $endAt,
        ]);

        /** @var User $user */
        $user = Auth::user();

        $user->events()->attach($event, ['owner' => true]);

        return redirect('/events/' . $event->id)
            ->with('success', 'Event created successfully.');

    }

    public function update(int $id, Request $request)
    {

        $title = $request->title;
        $description = $request->description;
        $startAt = Carbon::parse($request->start)->toDateTimeString();
        $endAt = Carbon::parse($request->end)->toDateTimeString();

        Event::where('id', $id)
            ->whereHas('participants', function($query) {
                $query->where('user_id', auth()->id());
                $query->where('owner', true);
            })
            ->update([
                'title' => $title,
                'description' => $description,
                'start_at' => $startAt,
                'end_at' => $endAt,
            ]);

        return redirect()
            ->back()
            ->with('success', 'Event updated successfully.');

    }

    public function destroy(int $id, Request $request)
    {

        $event = Event::where('id', $id)
            ->whereHas('participants', function($query) {
                $query->where('user_id', auth()->id());
            })
            ->first();

        if (!is_a($event, Event::class)) {
            return redirect('/')
                ->withErrors('This event could not be found.');
        }

        if (!$event->amIOwner()) {
            // Authenticated user is not the owner of event, but participant. Then leave it.
            $event->participants()->detach(auth()->id());
            return redirect('/')
                ->with('success', "You leave the event '{$event->title}'.");
        }

        // Authenticated user is the owner. Detach everyone and delete.
        $event->participants()->detach();
        $event->delete();

        return redirect('/')
            ->with('success', 'Your event has been deleted.');

    }

}
