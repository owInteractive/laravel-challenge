<?php

namespace App\Http\Controllers;

use App\Http\Requests\CsvImportRequest;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Excel;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($status = null)
    {
        
        $events = $status != null ? Auth::user()->events()->happen()->paginate(8) : Auth::user()->events()->paginate(8);

        

        return view('events.index', compact('events', 'status'));
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
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'start' => 'required',
            'end' => 'required|after:start',
        ]);


        $event = Event::create($request->all());


        return redirect('/admin/dashboard/')->with(['success' => 'Successfully created event']);
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
        return view('events.create', compact('event'));
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
        $event = Event::find($id);

        $event->update($request->all());

        return redirect('/admin/dashboard/')->with(['success' => 'Event updated successfully']);
    }

    public function import()
    {
        return view('events.import');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        $event->delete();

        return back()->with('success', 'Deleted Record successfully.');
    }

   

    /**
     * Up CSV file
     */

    public function importCSV(CsvImportRequest $request)
    {
        
        $path = $request->file('file')->getRealPath();

        $data = Excel::load($path)->get();


        if($data->count()){

            foreach ($data as $value) {
                
                $value = new Event([
                    'title' => $value->title,
                    'description' => $value->description,
                    'start' => $value->start,
                    'end' => $value->end,
                ]);

                $value->save();
                
            }
 
        }
 
        return back()->with('success', 'Insert Record successfully.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function downloadExcel($type)
    {
       
        $data = Event::get()->toArray();
            
        return Excel::create('my_events_ow_interactive', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download($type);
    }
}
