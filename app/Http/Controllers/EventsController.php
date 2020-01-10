<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;

class EventsController extends Controller
{

    public function index() {

        $events = Event::query()
            ->where('user_id', auth()->id())
            ->get()
            ->sortBy('start_at');

        return view('events.index', compact('events'));

    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $title = $request->title;
        $description = $request->description;
        $startAt = $request->start;
        $endAt = $request->end;

        Event::create([
            'title' => $title,
            'description' => $description,
            'start_at' => $startAt,
            'end_at' => $endAt,
            'user_id' => auth()->id(),
        ]);

        return redirect('/events');

    }

}
