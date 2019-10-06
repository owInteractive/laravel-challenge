<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Event;


class EventController extends Controller
{
    public function storeEvent(Request $request){
        $validator = Validator::make($request->all(), EventController::rulesEventsData());
      
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $combinatedBeginDateAndTime = EventController::combineDateAndTimeInUniqueVariable($request->beginDate, $request->beginTime);
        $combinatedEndDateAndTime = EventController::combineDateAndTimeInUniqueVariable($request->endDate, $request->endTime);

        if($combinatedEndDateAndTime < $combinatedBeginDateAndTime){
            return redirect()->back()->with('error', 'When the the end date and begin date are equal, 
            the end hour must be a hour after or equal to begin hour.');
        }

        $event = new Event;
        $event->title = $request->title;
        $event->description = $request->description;
        $event->start = $combinatedBeginDateAndTime;
        $event->end = $combinatedEndDateAndTime;
        $event->users_id = Auth::id();       

        $event->save();

        return redirect()->route('events.myevents', ['user'=>Auth::id()])->with('message', 'Success! Event was created.');

    }

    
    public function editEvent($user, $id){
        $event = Event::findOrFail($id);
        EventController::verifyIfUserEventOwnerEqualUserAuthID($event->users_id, $user);
        return view('events.edit', compact('event'));
    }

    public function showEvent($id){
        $event = Event::findOrFail($id);
        return view('events.show', compact('event'));
    }

    public function updateEvent (Request $request, $user, $id){
        $validator = Validator::make($request->all(), EventController::rulesEventsData());
      
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $combinatedBeginDateAndTime = EventController::combineDateAndTimeInUniqueVariable($request->beginDate, $request->beginTime);
        $combinatedEndDateAndTime = EventController::combineDateAndTimeInUniqueVariable($request->endDate, $request->endTime);

        if($combinatedEndDateAndTime < $combinatedBeginDateAndTime){
            return redirect()->back()->with('error', 'When the the end date and begin date are equal, 
            the end hour must be a hour after or equal to begin hour.');
        }

        $event = Event::findOrFail($id);

        EventController::verifyIfUserEventOwnerEqualUserAuthID($event->users_id, $user);

        $event->title = $request->title;
        $event->description = $request->description;
        $event->start = $combinatedBeginDateAndTime;
        $event->end = $combinatedEndDateAndTime;
        $event->save();
        return redirect()->route('events.show', ['id'=>$event->id])->with('message', 'Success! Event was updated!');

    }

    public function destroyEvent($user, $id){
        $event = Event::findOrFail($id);
        EventController::verifyIfUserEventOwnerEqualUserAuthID($event->users_id, $user);
        $event->delete();
        return redirect()->route('events.myevents', compact('user'))->with('message', 'Success! Event was deleted.!');
    }
     
    public function getTodayEventsList(){
        $date = date('Y-m-d');
        $events = Event::whereDate('start', '<=', $date)->whereDate('end', '>=', $date)->orderBy('start')->paginate(6);
        return view('home', compact('events'));
    }

    public function getNextFiveDaysEventsList(){
        $date = date('Y-m-d');
        $fiveDays = date('Y-m-d', strtotime('+5 day'));
        $events = Event::where(function($response) use ($date, $fiveDays){
                $response->whereDate('start', '>=', $date)->whereDate('start', '<=', $fiveDays);
            })
            ->orWhere(function($response) use ($date, $fiveDays){
                $response->whereDate('end', '>=', $date)->whereDate('end', '<=', $fiveDays);
            })
            ->orWhere(function($response) use ($date, $fiveDays){
                $response->whereDate('start', '<', $date)->whereDate('end', '>=', $fiveDays);
            })
            ->orderBy('start')
            ->paginate(6);

        return view('events.fiveDays', compact('events'));
    }

    public function getMyEventsList(){
        EventController::verifyAuthIDExists();

        $events = Event::where('users_id', Auth::id())->orderBy('created_at', 'DESC')->paginate(6);
        return view('events.myevents', compact('events'));
    }

    public function getAllEventsList(){
        $events = DB::table('events')->orderBy('start')->paginate(6);
        return view('events.allevents', compact('events'));
    }

    public function exportListOfEvents($archive, $type){
        $events = EventController::verifyTypeAndReturnListOfEvents($type);
        if(!isset($events)){
            return view('home');
        }
        
        Excel::create('events', function($excel) use($events) {
            $excel->sheet('ExportFile', function($sheet) use($events) {
                $sheet->fromArray($events);
            });
        })->export($archive);
  
    }
 
    public function importCsvView(){
        $events_created = [];
        return view('import', compact('events_created'));
    }

    public function storeImportedCSV(Request $request){
        EventController::verifyAuthIDExists();

        $validator = Validator::make($request->all(), EventController::rulesCsvFile());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $data = Excel::load($request->file('csv_file')->getRealPath(), function($reader) {})->get()->toArray();
        $allowedfileExtension=['csv','xls','txt'];
        $extension = $request->file('csv_file')->getClientOriginalExtension();
        $check=in_array($extension,$allowedfileExtension);

        if(!$check){
            return redirect()->back()->with('error', 'File with invalid extension!');
        }
        if (count($data) <= 0) {
            return redirect()->back()->with('error', 'Empty Archive!');
        }

        $csv_header_fields = EventController::takeCsvHeaderFields($data[0]);
        
        if(count($csv_header_fields)!=4){
            return redirect()->back()->with('error', 'CSV without valid header!');
        }
        if($csv_header_fields[0]!='title' || $csv_header_fields[1]!='description' 
        || $csv_header_fields[2]!='start' || $csv_header_fields[3]!='end'){
            return redirect()->back()->with('error', 'CSV without valid header!');
        }
        
        foreach($data as $info){
            $validator = Validator::make($info, EventController::rulesCsvImportedCreate());
            
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
        
        return view('import', compact('events_created'));
    }

    public function combineDateAndTimeInUniqueVariable($date, $hour){
        return date('Y-m-d H:i:s', strtotime("$date $hour"));
    }

    public function verifyIfUserEventOwnerEqualUserAuthID($EventUser, $AuthID){
        if ($EventUser!= $AuthID){
            return view('home');
        }
        return;
    }

    public function verifyTypeAndReturnListOfEvents($type){
        if($type=='all'){
            return EventController::getAllEventsListToExport();
        }
        else if($type=='today'){
            return EventController::getTodayEventsListToExport();
        }
        else if($type=='fiveDays'){
            return EventController::getNextFiveDaysEventsListToExport();
        }
        else if($type=='my'){
            return EventController::getMyEventsListToExport();
        }
        return;
    }

    public function takeCsvHeaderFields($data){
        $csv_header_fields = [];
        foreach ($data as $key => $value) {
            $csv_header_fields[] = $key;
        }
        return $csv_header_fields;
    }

    public function getTodayEventsListToExport(){
        $date = date('Y-m-d');
        return Event::select('title', 'description', 'start', 'end')
        ->whereDate('start', '<=', $date)
        ->whereDate('end', '>=', $date)
        ->orderBy('start')
        ->get();
    }

    public function getAllEventsListToExport(){
        return Event::select('title', 'description', 'start', 'end')
        ->orderBy('start')
        ->get();
    }
    public function getNextFiveDaysEventsListToExport(){
        $date = date('Y-m-d');
        $fiveDays = date('Y-m-d', strtotime('+5 day'));
        return Event::select('title', 'description', 'start', 'end')
            ->where(function($response) use ($date, $fiveDays){
                $response->whereDate('start', '>=', $date)->whereDate('start', '<=', $fiveDays);
            })
            ->orWhere(function($response) use ($date, $fiveDays){
                $response->whereDate('end', '>=', $date)->whereDate('end', '<=', $fiveDays);
            })
            ->orWhere(function($response) use ($date, $fiveDays){
                $response->whereDate('start', '<', $date)->whereDate('end', '>=', $fiveDays);
            })
            ->orderBy('start')
            ->get();
    }

    public function getMyEventsListToExport(){
        EventController::verifyAuthIDExists();
        return Event::select('title', 'description', 'start', 'end')
            ->where('users_id', Auth::id())
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    public function verifyAuthIDExists(){
        if (!Auth::id()){
            return view('home');
        }
        return;
    }

    public function rulesEventsData(){
        return [
            'title' => 'required|max:250',
            'description' => 'required|max:5000',
            'beginDate' => 'required|date',
            'beginTime' => 'required|date_format:H:i',
            'endDate' => 'required|date|after_or_equal:beginDate',
            'endTime' => 'required|date_format:H:i'
        ];
    }

    public function rulesCsvImportedCreate(){
        return [
            'title' => 'required|max:250',
            'description' => 'required|max:5000',
            'start' => 'required|date',
            'end' => 'required|date|after_or_equal:start'
        ];
    }


    public function rulesCsvFile(){
        return [
            'csv_file' => 'required|file'
        ];
    }
}
