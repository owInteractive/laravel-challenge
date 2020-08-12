<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Rules\EndTime;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\EventsImport;
use App\Exports\EventsExport;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::orderBy('updated_at','DESC')->paginate(10); //it will show 10 records by page

        return view('pages.events.index', ['events' => $events]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:50',
            'description' => 'required|max:200',
            'start_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|date_format:H:i',
            'end_date' => 'required|date|after_or_equal:start_date',
            'end_time' => ['required', 'date_format:H:i', new EndTime($request->start_date,$request->end_date,$request->start_time)],
        ]);

        $event = new Event;

        $event->title = $request->title;
        $event->description = $request->description;
        $event->start_date = $request->start_date;
        $event->start_time = $request->start_time;
        $event->end_date = $request->end_date;
        $event->end_time = $request->end_time;
        $event->user_id = Auth::user()->id;

        $event->save();

        return redirect('/events/search')->with('success', 'Event created!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::findOrFail($id);

        if($event->user_id == Auth::user()->id){
            return view('pages.events.edit', ['event' => $event]);
        }

        return redirect('/events/search')->with('error', 'You can not UPDATE this event because it does not own you.');
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:50',
            'description' => 'required|max:200',
            'start_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|date_format:H:i',
            'end_date' => 'required|date|after_or_equal:start_date',
            'end_time' => ['required', 'date_format:H:i', new EndTime($request->start_date,$request->end_date,$request->start_time)],
        ]);

        $event = Event::findOrFail($id);

        $event->title = $request->title;
        $event->description = $request->description;
        $event->start_date = $request->start_date;
        $event->start_time = $request->start_time;
        $event->end_date = $request->end_date;
        $event->end_time = $request->end_time;

        $event->save();

        return redirect('/events/search')->with('success', 'Event updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        
        if($event->user_id == Auth::user()->id){
            $event->delete();
            return redirect('/events/search')->with('success', 'Event deleted!');
        }

        return redirect('/events/search')->with('error', 'You can not DELETE this event because it does not own you.');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $events = [];
        $searchTypes = $this->getSearchTypes();
        $searchType = $request->searchType ?? 1;

        $query = Event::query();

        switch ($searchType) {
            case '1':
                $query->orderBy('updated_at','DESC');
                break;
            case '2':
                // $query->where('start_date',date("Y-m-d"))
                //         ->orWhere(function($query) {
                //             $query->where('start_date','<',date("Y-m-d"))
                //                   ->where('end_date', '>=',date("Y-m-d"));
                //         });
                $query->where('start_date',date("Y-m-d"));
                break;
            case '3':
                $more5days = date('Y-m-d', strtotime(date("Y-m-d"). ' + 5 days'));
                // $query->where('start_date','>=', date("Y-m-d"))
                //         ->where('end_date', '<=',$more5days)
                //         ->orWhere(function($query) use($more5days){
                //             $query->where('start_date','<',date("Y-m-d"))
                //                     ->where('end_date', '>=',date("Y-m-d"))
                //                     ->where('end_date', '<=',$more5days);
                //         });
                $query->where('start_date','>=', date("Y-m-d"))
                      ->where('end_date', '<=',$more5days);
                break;

            
            default:
                # code...
                break;
        }

        $results = $query->paginate(10);

        return view('pages.events.index', ['events' => $results, 'searchType' => $request->searchType, 'searchTypes' => $searchTypes]);
    }


        /**
    * @return \Illuminate\Support\Collection
    */
    public function fileImportExport()
    {
       return view('file-import');
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function fileImport(Request $request) 
    {
        if(!$request->has('import_file')){
            return back()->with('error', 'Choose a file.');;
        }

        Excel::import(new EventsImport, $request->file('import_file'));
        return back()->with('success', 'Events imported!');
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function fileExport() 
    {
        return Excel::download(new EventsExport, 'events_' . date("Y-m-d H:i").'.csv');
    }    


    public function getSearchTypes(){
        return [
            (object) array('id' => '1','description' => 'All events'),
            (object) array('id' => '2','description' => 'Today events'),
            (object) array('id' => '3','description' => 'Next 5 days events')
        ];

    }
}
