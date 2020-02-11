<?php

namespace App\Http\Controllers;

Use App\Event;
Use App\Invite;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($period = "today")
    {
        $title = "";
        $paginate = false;
        switch ($period) {
            case 'today':
                $title = "Today events";
                $data = Event::where('public', 1)
                        ->where('start_date' , '<=', date('Y-m-d'))
                        ->where('finish_date' , '>=', date('Y-m-d'))
                        ->where('user_id', \Auth::user()->id)
                        ->get();
                $feedbacks_db = DB::table('events')
                        ->join('invites', 'event_id', '=', 'events.id')
                        ->select(DB::raw('count(status) as amount, status, event_id'))
                        ->where('start_date' , '<=', date('Y-m-d'))
                        ->where('finish_date' , '>=', date('Y-m-d'))
                        ->where('user_id', \Auth::user()->id)
                        ->groupBy('event_id')
                        ->groupBy('status')
                        ->get();
            break;
            case 'fiveDays':
                $title = "Events for the next 5 days";
                $data = Event::where('public', 1)
                        ->where('start_date' , '>=', date('Y-m-d', strtotime("+5 days")))
                        ->where('finish_date' , '>=', date('Y-m-d', strtotime("+5 days")))
                        ->where('user_id', \Auth::user()->id)
                        ->get();
                $feedbacks_db = DB::table('events')
                        ->join('invites', 'event_id', '=', 'events.id')
                        ->select(DB::raw('count(status) as amount, status, event_id'))
                        ->where('start_date' , '>=', date('Y-m-d', strtotime("+5 days")))
                        ->where('finish_date' , '>=', date('Y-m-d', strtotime("+5 days")))
                        ->where('user_id', \Auth::user()->id)
                        ->groupBy('event_id')
                        ->groupBy('status')
                        ->get();
            break;
            case 'all':
                $title = "All events";
                $data = Event::where('public', 1)
                        ->where('user_id', \Auth::user()->id)
                        ->paginate(10);
                $feedbacks_db = DB::table('events')
                        ->join('invites', 'event_id', '=', 'events.id')
                        ->select(DB::raw('count(status) as amount, status, event_id'))
                        ->where('user_id', \Auth::user()->id)
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

        return view('home')->with('data', $data);
    }
}
