<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use App\Imports\Eventsmport;
use App\Exports\EventExport;
use Carbon\Carbon;


class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        
        $events = $user->events()->paginate(2);
        

        return view("events.index")->with(['events'=>$events]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        
        $request->merge(["user_id"=>$user->id]);
// dd($request->all());

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'start' => 'required',
            'end' => 'required'
        ]);
  
        Event::create($request->all());
   
        return redirect()->route('events.index')
                        ->with('success','Product created successfully.');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();
  
        return redirect()->route('events.index')
                        ->with('success','Product deleted successfully');
    }

    public function import(){
        return view('events.import');
    }

    public function exportEvents(){
        $user = auth()->user();
        $events = $user->events()->select('title','description','start','end')->get()->toArray();
        array_unshift($events,['title','description','start','end']);// add column headers
        $export = new EventExport($events);
        return Excel::download($export, 'events.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    public function importEvents(Request $request){
        $user = auth()->user();
        $validator = Validator::make($request->all(), EventController::rules_csv());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }   

        $data = Excel::toArray(new Eventsmport,  request()->file('csv_file'));

        foreach($data[0] as $info){
            Event::create([
                'title' => $info['title'],
                'description' => $info['description'],
                'start' => Carbon::createFromFormat('m/d/Y H:i:s', $info['start'])->toDateTimeString(),
                'end' => Carbon::createFromFormat('m/d/Y H:i:s', $info['end'])->toDateTimeString(),
                'user_id' => $user->id
            ]);
        }  

        return redirect()->back();
    }

    public function rules(){
        return [
            'title' => 'required|max:250',
            'description' => 'required|max:5000',
            'beginDate' => 'required|date',
            'beginTime' => 'required|date_format:H:i',
            'endDate' => 'required|date|after:beginDate',
            'endTime' => 'required|date_format:H:i'
        ];
    }

    public function rules_csv()
    {
        return [
            'csv_file' => 'required|file'
        ];
    }
}
