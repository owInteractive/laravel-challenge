<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    //Index that lists all events
    public function index() {
        $events = Event::where('user_id', Auth::user()->id)->paginate(10);

        return view('event.index', compact('events'));
    }

    //Store a new event
    public function store(Request $request) {
        $event = Event::findOrNew($request->id);

        $event->user_id = Auth::user()->id;

        $event->fill($request->except('id'));
        $event->save();

        return redirect('/event')->with('success', 'Event has been added');
    }
    
    //Filter to list envets by all, upcoming events in five days, or events running in current date
    public function filter($filter) {
        if ($filter == 'all') {
            $events = Event::where('user_id', Auth::user()->id)->paginate(10);
          } 
          else if ($filter == 'five') {
            $events = Event::where('user_id', Auth::user()->id)
                ->where('date_time_start', '<', Carbon::today()->addDays(6))->where('date_time_end', '>=', Carbon::today())->paginate(10);
          }
          else if ($filter == 'today') {
            $events = Event::where('user_id', Auth::user()->id)
                ->where('date_time_start', '<', Carbon::today()->addDays(1))->where('date_time_end', '>=', Carbon::today())->paginate(10);
          }

          return view('event.index', compact('events'));
    }

    //Show event by id
    public function show($id) {   
        $event = Event::findOrNew($id);

        return view('event.form', compact('event'));
    }

    //Delete event by id
    public function destroy() {
        $event = Event::findOrFail($id);
        $event->delete();
        
        return redirect('/event')->with('success', 'Event has been deleted Successfully');
    }

}
