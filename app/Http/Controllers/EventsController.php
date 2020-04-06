<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Events;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use DB;

class EventsController extends Controller
{
    private $items_per_page = 10;

    public function index(){
        $title = 'All events';
        $events = Events::filters()->allEvents()->paginate($this->items_per_page);
        return view('panel.events', compact('title', 'events'));
    }

    public function nextDays($days = 5){
        $title = 'All events in '.$days.' days';
        $events = Events::filters()->nextDays($days)->paginate($this->items_per_page);
        return view('panel.events', compact('title', 'events'));
    }

    public function today($days = 5){
        $title = 'Today events';
        $events = Events::filters()->today()->paginate($this->items_per_page);
        return view('panel.events', compact('title', 'events'));
    }

    public function add(){
        $title = 'Add Event';
        return view('panel.view_event', compact('title'));
    }

    public function edit($id_event){
        $title = 'Edit Event';

        $event = Events::where('id', $id_event)
                       ->where('id_user', Auth::user()->id)
                       ->first();
        return view('panel.view_event', compact('title', 'event'));
    }

    public function delete($id_event){
        $event = Events::where('id', $id_event)
            ->where('id_user', Auth::user()->id)
            ->first();
        $event->delete();

        return redirect()->route('events');
    }

    public function submit(Request $request, $id_event = null){
        $this->validate($request, [
            'title' => 'required|string|max:50',
            'description' => 'required|string|max:150',
            'event_starts' => 'required|before_or_equal:event_ends|date_format:d/m/Y',
            'event_ends' => 'required|after_or_equal:event_starts|date_format:d/m/Y',
        ]);

        $event = Events::submit($request, $id_event);
        return redirect()->route('events');

    }

    public function importCsv(Request $request){
        $this->validate($request, [
            'file_csv' => 'required|file'
        ]);

        if($request->hasFile('file_csv')){
			$path = $request->file('file_csv')->getRealPath();
			$data = Excel::load($path, function($reader) {
			})->get();
			if(!empty($data) && $data->count()){
				foreach ($data as $key => $value) {
                    $insert[] = 
                        [
                            'title'             => $value->title,
                            'description'       => $value->description,
                            'id_user'           => $value->id_user,
                            'event_starts_at'   => date('Y-m-d', strtotime($value->event_starts_at)),
                            'event_ends_at'     => date('Y-m-d', strtotime($value->event_ends_at)),
                            'deleted_at'        => $value->deleted_at,
                            'created_at'        => $value->created_at,
                            'updated_at'        => $value->updated_at
                        ];
                }
                
				if(!empty($insert)){
					DB::table('events')->insert($insert);
					dd('Insert Record successfully.');
				}
			}
		}
    }

    public function exportCsv(Request $request){

        $data = Events::all()->toArray();

		Excel::create('events', function($excel) use ($data) {
			$excel->sheet('Events', function($sheet) use ($data)
	        {
				$sheet->fromArray($data);
	        });
        })->download('csv');
        
        return redirect()->route('events');

    }
}
