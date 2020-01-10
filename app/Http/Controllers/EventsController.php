<?php

namespace App\Http\Controllers;

use App\Event;

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

}
