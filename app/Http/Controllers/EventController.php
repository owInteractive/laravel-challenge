<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DateTime;
use App\Event;
use App\Repositories\EventRepository;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{

    protected $events;

    public function __construct(EventRepository $events)
    {
        $this->middleware('auth');

        $this->events = $events;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $events = $this->events->forUser($request->user());

        $events = Event::where('user_id', $request->user()->id)
            ->orderBy('starts_at')->paginate(5);

        $eventDay = 'All';

        return view('home', compact('events'), compact('eventDay'));
    }

    public function fiveDays(Request $request)
    {
        $events = $this->events
            ->forUser($request->user())
            ->where('starts_at', '>=', date('Y-m-d'))
            ->where('starts_at', '<=', date('Y-m-d', strtotime("+5 day")))
            ->sortBy('starts_at');

        $eventDay = 'Next five days';

        return view('home', compact('events'), compact('eventDay'));
    }

    public function today(Request $request)
    {
        $events = $this->events->forUser($request->user())
            ->where('starts_at', date('Y-m-d'))
            ->sortBy('starts_at');

        $eventDay = 'Today';

        return view('home', compact('events'), compact('eventDay'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required|max:512',
            'startsAt' => 'required',
            'endsAt' => 'required|date|after_or_equal:startsAt',
        ]);

        $request->user()->events()->create([
            'title' => $request->title,
            'description' => $request->description,
            'starts_at' => $request->startsAt,
            'ends_at' => $request->endsAt,
        ]);

        return redirect('/events');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Event $event)
    {
        $event->delete();

        return redirect('/events');
    }

    public function export(Request $request, $day){
        
        $contents = '';

        if ($day == 'Today') {

            $events = $this->events
                        ->forUser($request->user())
                        ->where('starts_at', date('Y-m-d'))
                        ->sortBy('starts_at');

            foreach ($events AS $event) {
                $contents .= "{$event->user_id},{$event->title},{$event->description},{$event->starts_at},{$event->ends_at}" . PHP_EOL;
            }

        }else if ($day == 'Next five days') {

            $events = $this->events
                        ->forUser($request->user())
                        ->where('starts_at', '>=', date('Y-m-d'))
                        ->where('starts_at', '<=', date('Y-m-d', strtotime("+5 day")))
                        ->sortBy('starts_at');

            foreach ($events AS $event) {
                $contents .= "{$event->user_id},{$event->title},{$event->description},{$event->starts_at},{$event->ends_at}" . PHP_EOL;
            }

        }else if ($day == 'All') {

            $events = Event::where('user_id', $request->user()->id)
                        ->orderBy('starts_at')->get();

            foreach ($events AS $event) {
                $contents .= "{$event->user_id},{$event->title},{$event->description},{$event->starts_at},{$event->ends_at}" . PHP_EOL;
            }

        }

        Storage::disk('public')->put('events.csv', $contents);

        return asset('Events.csv');

    }

    public function import(request $request){

        $file = Storage::disk('public')->put('eventsImport.csv', $request->file('csv'));
        $fileContents = Storage::disk('public')->get($file);
        $contents = explode(PHP_EOL ,$fileContents);
        // $csv = array_map('str_getcsv', $request->file('csv'));

        foreach ($contents AS $content) {

            $column = explode(',', $content);

            if (count($column) == 5) {

                $format = 'Y-m-d';
                $date = $column[3];
                $d = DateTime::createFromFormat($format, $date);
                $validStarts = $d && $d->format($format) === $date;

                $date = $column[4];
                $d = DateTime::createFromFormat($format, $date);
                $validEnds = $d && $d->format($format) === $date;

                if ($validStarts && $validEnds) {
                    $event = new Event;

                    $event->user_id = $column[0];
                    $event->title = $column[1];
                    $event->description = $column[2];
                    $event->starts_at = $column[3];
                    $event->ends_at = $column[4];

                    $event->save();
                } 

            }

        }

        return redirect('home');
        
    }

}
