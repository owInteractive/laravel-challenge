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
            ->orderBy('start_at')
            ->paginate(15);

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
