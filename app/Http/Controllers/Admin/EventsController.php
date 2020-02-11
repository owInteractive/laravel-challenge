<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\EventsExport;
use App\Imports\EventsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Event;
use Carbon\Carbon;

class EventsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::orderBy('end_datetime', 'desc')->paginate(5);

        return view('admin.events', [
            'events' => $events,
            'days' => 'All Events'
            ]);
    }

    public function getEventsToday()
    {
        $events = Event::where('start_date', '=', Carbon::today())
        ->orwhere('end_datetime', '=', Carbon::today())
        ->orderBy('end_datetime', 'desc')
        ->paginate(5);

        return view('admin.events', [
            'events' => $events,
            'days' => 'Today Events'
            ]);
    }

    public function getEventsNextDays()
    {
        $events = Event::where('start_date', '<=', Carbon::today()->adddays(5))
        ->orWhere('end_datetime', '<=', Carbon::today()->adddays(5))
        ->orderBy('end_datetime', 'desc')
        ->paginate(5);

        return view('admin.events', [
            'events' => $events,
            'days' => 'Events next 5 days'
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'title',
            'startdate',
            'enddate',
            'description'
        ]);

        $validator = Validator::make($data, [
            'title' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string', 'max:200'],
            'startdate' => ['required', 'string', 'max:100'],
            'enddate' => ['required', 'string', 'max:100']
        ]);

        if($validator->fails()) {
            return redirect()->route('events.create')
            ->withErrors($validator)
            ->withInput();
        }

        $event = new Event;
        $event->user_id = Auth::user()->id;
        $event->description = $data['description'];
        $event->title = $data['title'];

        $startdate = str_replace('/','-', $data['startdate']);
        $enddate = str_replace('/', '-', $data['enddate']);

        $event->start_date = date('Y-m-d', strtotime($startdate));
        $event->end_datetime = date('Y-m-d', strtotime($enddate));
        $event->save();

        return redirect()->route('events.index');
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
        $event = Event::find($id);

        return view('admin.edit', [
            'event' => $event
        ]);
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
        $data = $request->only([
            'title',
            'description',
            'startdate',
            'enddate'
        ]);

        $validator = Validator::make($data,[
            'title' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string', 'max:200'],
            'startdate' => ['required', 'string', 'max:100'],
            'enddate' => ['required', 'string', 'max:100']
        ]);

        if($validator->fails()) {
            return redirect()->route('events.edit', $id)
            ->withErrors($validator)
            ->withInput();
        }

        $event = Event::find($id);
        
        $event->title = $request->title;
        $event->description = $request->description;

        $startdate = str_replace('/','-', $data['startdate']);
        $enddate = str_replace('/', '-', $data['enddate']);

        $event->start_date = date('Y-m-d', strtotime($startdate));
        $event->end_datetime = date('Y-m-d', strtotime($enddate));
        $event->save();

        return redirect()->route('events.index');
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
        $event->delete();

        return redirect()->route('events.index');
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function importExportView()
    {
       return view('admin.import');
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function export() 
    {
        return Excel::download(new EventsExport, 'events.csv');
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function import() 
    {
        Excel::import(new EventsImport,request()->file('file'));
           
        return redirect()->route('events.index');
    }

}
