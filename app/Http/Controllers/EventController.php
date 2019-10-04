<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;



use App\Event;
class EventController extends Controller
{
    public function store(Request $request){
        $validator = Validator::make($request->all(), EventController::rules());
      
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        if(date('Y-m-d', strtotime($request->beginDate)) == date('Y-m-d', strtotime($request->endDate))){
            if(date('H:i', strtotime($request->beginTime)) > date('H:i', strtotime($request->endTime))){
                return redirect()->back()->with('error', 'When the the end date and begin date are equal, the end hour must be a hour after or equal to begin hour.');
            }
        }

        $event = new Event;
        $event->title = $request->title;
        $event->description = $request->description;
        $combinedDTBegin = date('Y-m-d H:i:s', strtotime("$request->beginDate $request->beginTime"));
        $combinedDTEnd = date('Y-m-d H:i:s', strtotime("$request->endDate $request->endTime"));
        $event->start = $combinedDTBegin;
        $event->end = $combinedDTEnd;
        $event->users_id = Auth::id();       
        $event->save();
        return redirect()->back()->with('message', 'Success! Event was created.');

    }
    
    public function edit($user, $id){
        $event = Event::findOrFail($id);
        if ($event->users_id != $user){
            return view('home');
        }
        return view('events.edit', compact('event'));
    }

    public function show($id){
        $event = Event::findOrFail($id);
        return view('events.show', compact('event'));
    }

    public function update (Request $request, $user, $id){
        $validator = Validator::make($request->all(), EventController::rules());
      
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $event = Event::findOrFail($id);

        if ($event->users_id != $user){
            return view('home');
        }

        $event->title = $request->title;
        $event->description = $request->description;
        $combinedDTBegin = date('Y-m-d H:i:s', strtotime("$request->beginDate $request->beginTime"));
        $combinedDTEnd = date('Y-m-d H:i:s', strtotime("$request->endDate $request->endTime"));
        $event->start = $combinedDTBegin;
        $event->end = $combinedDTEnd;
        $event->save();
        return redirect()->back()->with('message', 'Success! Event was updated!');

    }

    public function destroy($user, $id){
        $event = Event::findOrFail($id);
        if($user != $event->users_id){
            return view('home');
        }
        $event->delete();
        return redirect()->route('events.myevents', compact('user'))->with('message', 'Success! Event was deleted.!');
    }
     
    public function todayEvents(){
        $date = date('Y-m-d');
        $events = Event::whereDate('start', '<=', $date)->whereDate('end', '>=', $date)->orderBy('start')->paginate(6);
        return view('home', compact('events'));
    }

    public function nextFiveDays(){
        $date = date('Y-m-d');
        $fiveDays = date('Y-m-d', strtotime('+5 day'));
        //$events = Event::whereDate('start', '>=', $date)->whereDate('start', '<=', $fiveDays)->get();
        $events = Event::where(function($q) use ($date, $fiveDays){
                $q->whereDate('start', '>=', $date)->whereDate('start', '<=', $fiveDays);
            })
            ->orWhere(function($q) use ($date, $fiveDays){
                $q->whereDate('end', '>=', $date)->whereDate('end', '<=', $fiveDays);
            })
            ->orWhere(function($q) use ($date, $fiveDays){
                $q->whereDate('start', '<', $date)->whereDate('end', '>=', $fiveDays);
            })
            ->orderBy('start')
            ->paginate(6);
        return view('events.fiveDays', compact('events'));
    }

    public function myEvents(){

        if (!Auth::id()){
            return view('home');
        }

        $events = Event::where('users_id', Auth::id())->orderBy('created_at', 'DESC')->paginate(6);
        return view('events.myevents', compact('events'));
    }

    public function allEvents(){
        $events = DB::table('events')->orderBy('start')->paginate(6);
        return view('events.allevents', compact('events'));
    }

    public function export($archive, $type){
        if($type=='all'){
            $events = Event::select('title', 'description', 'start', 'end')->orderBy('start')->get();
        }
        else if($type=='today'){
            $date = date('Y-m-d');
            $events = Event::select('title', 'description', 'start', 'end')->whereDate('start', '<=', $date)->whereDate('end', '>=', $date)->orderBy('start')->get();
        }
        else if($type=='fiveDays'){
            $date = date('Y-m-d');
            $fiveDays = date('Y-m-d', strtotime('+5 day'));
            //$events = Event::whereDate('start', '>=', $date)->whereDate('start', '<=', $fiveDays)->get();
            $events = Event::select('title', 'description', 'start', 'end')
                ->where(function($q) use ($date, $fiveDays){
                    $q->whereDate('start', '>=', $date)->whereDate('start', '<=', $fiveDays);
                })
                ->orWhere(function($q) use ($date, $fiveDays){
                    $q->whereDate('end', '>=', $date)->whereDate('end', '<=', $fiveDays);
                })
                ->orWhere(function($q) use ($date, $fiveDays){
                    $q->whereDate('start', '<', $date)->whereDate('end', '>=', $fiveDays);
                })
                ->orderBy('start')
                ->get();
        }
        else if($type=='my'){
            if (!Auth::id()){
                return view('home');
            }
    
            $events = Event::select('title', 'description', 'start', 'end')->where('users_id', Auth::id())->orderBy('created_at', 'DESC')->get();
        }

        if(!isset($events)){
            return view('home');
        }
        
        Excel::create('events', function($excel) use($events) {
            $excel->sheet('ExportFile', function($sheet) use($events) {
                $sheet->fromArray($events);
            });
        })->export($archive);
  
    }

    
    public function importCSVindex(){
        $events_created = [];
        return view('import', compact('events_created'));
    }

    public function importCSV(Request $request){
        if (!Auth::id()){
            return view('home');
        }
        $validator = Validator::make($request->all(), EventController::rules_csv());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }   

        $path = $request->file('csv_file')->getRealPath();
       
        $data = Excel::load($path, function($reader) {})->get()->toArray();
        // ".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel, text/plain"
        if (count($data) > 0) {
            $csv_header_fields = [];
            foreach ($data[0] as $key => $value) {
                $csv_header_fields[] = $key;
            }
            if($csv_header_fields[0]!='title' || $csv_header_fields[1]!='description' || $csv_header_fields[2]!='start' || $csv_header_fields[3]!='end'){
                return redirect()->back()->with('error', 'CSV without valid header!');;
            } 
            //$csv_data = array_slice($data, 0, 2);
           
            foreach($data as $info){
                $validator = Validator::make($info, EventController::rules_importCSV());
                
                if ($validator->fails()) {
                    return redirect()->back()->with('error', 'CSV file have fields in wrong format.');
                }

                $events_created[]=Event::create([
                    'title' => $info['title'],
                    'description' => $info['description'],
                    'start' => $info['start'],
                    'end' => $info['end'],
                    'users_id' => Auth::id()
                ]);
            }  
        }
        else {
            return redirect()->back()->with('error', 'Empty Archive!');;
        } 
        
        return view('import', compact('events_created'));
    }


    public function rules(){
        return [
            'title' => 'required|max:250',
            'description' => 'required|max:5000',
            'beginDate' => 'required|date',
            'beginTime' => 'required|date_format:H:i',
            'endDate' => 'required|date|after_or_equal:beginDate',
            'endTime' => 'required|date_format:H:i'
        ];
    }

    public function rules_importCSV(){
        return [
            'title' => 'required|max:250',
            'description' => 'required|max:5000',
            'start' => 'required|date',
            'end' => 'required|date|after_or_equal:start'
        ];
    }


    public function rules_csv()
    {
        return [
            'csv_file' => 'required|file'
        ];
    }
}
