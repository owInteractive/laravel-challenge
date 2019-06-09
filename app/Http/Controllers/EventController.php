<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{

  /**
   * Return to event.index all events from authenticated user
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $events = Event::where('user_id', Auth::user()->id)->paginate(10);
    return view('event.index', compact('events'));
  }

  /**
   * Return to event.index all events from authenticated user that applies to the parameter filter
   *
   * @param string $filter options = 'all', 'five' and 'today';
   * @return \Illuminate\Http\Response
   */
  public function filter($filter)
  {
    if ($filter == 'all') {
      $events = Event::where('user_id', Auth::user()->id)->paginate(10);
    } else if ($filter == 'five') {
      $events = Event::where('user_id', Auth::user()->id)->where('date_time_start', '<', Carbon::today()->addDays(6))->where('date_time_end', '>=', Carbon::today())->paginate(10);
    } else if ($filter == 'today') {
      $events = Event::where('user_id', Auth::user()->id)->where('date_time_start', '<', Carbon::today()->addDays(1))->where('date_time_end', '>=', Carbon::today())->paginate(10);
    }
    return view('event.index', compact('events'));
  }

  /**
   * Redirects to event.form passing the event to edit if $id exists
   *
   * @param integer $id Event ID
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $event = Event::findOrNew($id);
    return view('event.form', compact('event'));
  }

  /**
   * Store a new event from request or edit if $request->id exists on DB
   *
   * @param Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $event = Event::findOrNew($request->id);
    $event->user_id = Auth::user()->id;
    $event->fill($request->except('id'));
    $event->save();
    return redirect('/event')->with('success', 'Event has been added');
  }

  /**
   * Deletes an event based on parameter id
   *
   * @param integer $id Event ID
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $event = Event::findOrFail($id);
    $event->delete();
    return redirect('/event')->with('success', 'Event has been deleted Successfully');
  }
}
