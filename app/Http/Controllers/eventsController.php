<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Event;
use App\Notification;
use App\Exports\EventsExport;
use App\Imports\EventsImport;
use Carbon\Carbon;
use Excel;  


class eventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = DB::table('events')->paginate(5);
        return response()->json($events);
    }
    public function eventsAfterFiveDays()
    {
        $events = Event::where('start_datetime' , '>=' , Carbon::now()->addDays(5)->toDateString())->paginate(5);
        return response()->json($events);
    }

    public function todayEvents()
    {
        $events = Event::where('start_datetime' , Carbon::now()->toDateString())->paginate(5);
        return response()->json($events);
    }
    public function export() 
    { 
        return Excel::download(new EventsExport, 'events.csv');
    }

    public function import() 
    {
       
        return Excel::import(new EventsImport, request()->file('file'));
    } 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    public function singleEvent($id)
    {
        $event = Event::where('id', $id)->first();
        return $event;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $event = new Event([
           'user_id' => Auth::user()->id,
           'title' => $request->title,
           'description' => $request->description,
           'start_datetime' => $request->start_datetime,
           'end_datetime' => $request->end_datetime,
       ]);
       $event->save();
       return Response()->json($event);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        $event->title = $request->get('title');
        $event->description = $request->get('description');
        $event->start_datetime = $request->get('start_datetime');
        $event->end_datetime = $request->get('end_datetime');
        $event->save();
        return Response()->json($event);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::find($id);
        $notif = Notification::where('event_id',$id)->get();
        foreach($notif as $n){
            $n->delete();
        }
        $event->delete();
        return Response()->json('deleted sucessfully');
    }
}
