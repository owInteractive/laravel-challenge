<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Ramsey\Uuid\Uuid;


class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::where('user_id', \Auth::user()->id)->paginate(3);
        // $img = Storage::get('/public/party-1.jpg');
        // $img = base64_encode($img);
        
        
        $data = [
            'events'    => $events
        ];
        return view('events.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // If the start date is equal than the finish date, the finish time must be greater than the start time
        $rule_finish_time = ($request->input('start_date') == $request->input('finish_date')) ? '|after:start_time' : '';
        // Custom rule
        $rule = [
            'title' => 'required',
            'description' => 'required',
            'start_date' => 'date_format:Y-m-d|after:yesterday',
            'start_time' => 'date_format:H:i|after:now',
            'finish_date' => 'date_format:Y-m-d|after_or_equal:start_time',
            'finish_time' => 'date_format:H:i' . $rule_finish_time
        ];
        // Validating
        $this->validate($request, $rule);
        // Creating new event
        $event = new Event();
        $event->user_id = \Auth::user()->id;
        $event->title = $request->input('title');
        $event->description = $request->input('description');
        $event->start_date = "{$request->input('start_date')} {$request->input('start_time')}:00";
        $event->finish_date = "{$request->input('finish_date')} {$request->input('finish_time')}:00";
        $event->public = 1;
        // Applying
        return response()->json($event->save());
    }

    /**
     * Display the specified resource.
     *
     * @param  GET  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd('aq');
        // Decrypting the id
        $id = Event::decryptId($id);
        $event = Event::find($id);

        return response()->json(['event' => $event]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  GET id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Decrypting the id
        $id = Event::decryptId($id);
        $event = Event::find($id);
        
        // If has no event
        if(empty($event)) {
            return redirect(route('event-list'))->withErrors('This event does not exists!');
        }

        // If the authenticated user is the event owner
        if($event['user_id'] === \Auth::user()->id){
            return view('events.edit')->with('event', $event);
        } else {
            return redirect(route('event-list'))->withErrors('This event does not belong to you!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  GET id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        // Decrypting the id
        $id = Event::decryptId($id);
        $event = Event::find($id);

        // If has no event
        if(empty($event)) {
            return redirect(route('event-list'))->withErrors('This event does not exists!');
        }

        // If the authenticated user is not the event owner
        if($event['user_id'] != \Auth::user()->id) return redirect(route('event-list'))->withErrors('This event does not belong to you!');

        // If the start date is equal than the finish date, the finish time must be greater than the start time
        $rule_finish_time = ($request->input('start_date') == $request->input('finish_date')) ? '|after:start_time' : '';
        // Custom rule
        $rule = [
            'title' => 'required',
            'description' => 'required',
            'start_date' => 'date_format:Y-m-d|after:yesterday',
            'start_time' => 'date_format:H:i|after:now',
            'finish_date' => 'date_format:Y-m-d|after_or_equal:start_time',
            'finish_time' => 'date_format:H:i' . $rule_finish_time
        ];
        
        // Validating
        $this->validate($request, $rule);
        
        $event->title = $request->input('title');
        $event->description = $request->input('description');
        $event->start_date = "{$request->input('start_date')} {$request->input('start_time')}:00";
        $event->finish_date = "{$request->input('finish_date')} {$request->input('finish_time')}:00";
        
        // Applying
        return response()->json($event->save());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  GET  id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Decrypting the id
        $id = Event::decryptId($id);
        $event = Event::find($id);

        // If the authenticated user is not the event owner
        if($event['user_id'] != \Auth::user()->id) return response()->json(['error' => ['This event does not belong to you!']], 400);

        return response()->json($event->delete());
    }

    /**
     * List all events using the selected period
     * 
     * @param GET period
     * @return \Illuminate\Http\Response
     */
    public function list($period = "today") {
        $title = "";
        $paginate = false;
        switch ($period) {
            case 'today':
                $title = "Today events";
                $data = Event::where('public', 1)
                        ->where('start_date' , '<=', date('Y-m-d'))
                        ->where('finish_date' , '>=', date('Y-m-d'))
                        ->get();
                $feedbacks_db = DB::table('events')
                        ->join('invites', 'event_id', '=', 'events.id')
                        ->select(DB::raw('count(status) as amount, status, event_id'))
                        ->where('start_date' , '<=', date('Y-m-d'))
                        ->where('finish_date' , '>=', date('Y-m-d'))
                        ->groupBy('event_id')
                        ->groupBy('status')
                        ->get();
            break;
            case 'fiveDays':
                $title = "Events for the next 5 days";
                $data = Event::where('public', 1)
                        ->where('start_date' , '>=', date('Y-m-d', strtotime("+5 days")))
                        ->where('finish_date' , '>=', date('Y-m-d', strtotime("+5 days")))
                        ->get();
                $feedbacks_db = DB::table('events')
                        ->join('invites', 'event_id', '=', 'events.id')
                        ->select(DB::raw('count(status) as amount, status, event_id'))
                        ->where('start_date' , '>=', date('Y-m-d', strtotime("+5 days")))
                        ->where('finish_date' , '>=', date('Y-m-d', strtotime("+5 days")))
                        ->groupBy('event_id')
                        ->groupBy('status')
                        ->get();
            break;
            case 'all':
                $title = "All events";
                $data = Event::where('public', 1)
                        ->paginate(10);
                $feedbacks_db = DB::table('events')
                        ->join('invites', 'event_id', '=', 'events.id')
                        ->select(DB::raw('count(status) as amount, status, event_id'))
                        ->groupBy('event_id')
                        ->groupBy('status')
                        ->get();
                $paginate = true;
            break;
            
            default:
                # code...
                break;
        }
        
        $feedbacks = [];
        
        $confirmed = 0;
        $interested = 0;
        $denied = 0;

        foreach($feedbacks_db as $value) {
            $feedbacks[$value->event_id][$value->status] = $value->amount;

            if($value->status == 1) $interested++;
            if($value->status == 2) $confirmed++;
            if($value->status == 3) $denied++;
        }

        $panels = [
            'confirmed' => $confirmed,
            'interested' => $interested,
            'denied' => $denied
        ];

        $data = [
            'data' => $data,
            'feedbacks' => $feedbacks,
            'panels' => $panels,
            'title' => $title,
            'paginate' => $paginate
        ];

        // dd($data);

        return view('events.list')->with('data', $data);
    }

    /**
     * Export events to xlsx with random name
     * @return \Illuminate\Http\Response
     */
    public function export() {
        $name = (string) Uuid::uuid4();
        return Excel::download(new \App\Exports\EventsExport, "{$name}.xlsx");
    }

    /**
     * Import xlsx
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request) {
        $this->validate($request, [
            'select_file'  => 'required|mimes:xls,xlsx'
        ]);

        if($request->hasFile('select_file')) {
            $file = $request->file('select_file');
            Excel::import(new \App\Imports\EventsImport ,request()->file('select_file'));

            $events = Event::where('user_id', \Auth::user()->id)->paginate(3);
            $data = ['events' => $events];

            return redirect('/events?import=true')->with('data', $data);
        }
        
    }
}
