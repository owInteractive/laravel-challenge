<?php

namespace App\Http\Controllers;

use App\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventsController extends Controller
{

    public function index() {

        $events = Event::query()
            ->where('user_id', auth()->id())
            ->get()
            ->sortBy('start_at');

        $calendar = Event::groupByDay($events);
        return view('events.index', compact('calendar'));

    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $title = $request->title;
        $description = $request->description;
        $startAt = Carbon::parse($request->start)->toDateTimeString();
        $endAt = Carbon::parse($request->end)->toDateTimeString();

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
