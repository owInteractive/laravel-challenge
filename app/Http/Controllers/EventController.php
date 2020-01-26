<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Maatwebsite\Excel\Facades\Excel;
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
        
        $events = $user->events()->paginate(5);
        

        return view("events.index")->with(['events'=>$events]);
    }

    public function nextfive()
    {
        $user = auth()->user();
        
        $events = Event::creator($user)->nextDays(5)->get();

        return view("events.index")->with(['events'=>$events]);
    }

    public function today()
    {
        $user = auth()->user();
        
        $events = Event::creator($user)->today()->get();
        

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
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'start' => 'required',
            'end' => 'required'
        ]);
  
        Event::create($request->all());
   
        return redirect()->route('events.index')
                        ->with('success','Evento criado com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::find($id);
        // dd($event->confirmations()->orderBy('name')->get());
        $event->confirmations = $event->confirmations()->orderBy('name')->get();
        return view('events.show')->with(['event'=> $event]);
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
        return view('events.edit')->with(['event'=> $event]);
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
        $event = Event::find($id)->update($request->all());

        return redirect()->route('events.index')
                        ->with('success','Evento editado com sucesso.');
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
        $data = Excel::toArray(new Eventsmport,  request()->file('csv_file'));

        $line = 1;
        try{
            foreach($data[0] as $info){
                Event::create([
                    'title' => $info['title'],
                    'description' => $info['description'],
                    'start' => Carbon::createFromFormat('m/d/Y H:i:s', $info['start'])->toDateTimeString(),
                    'end' => Carbon::createFromFormat('m/d/Y H:i:s', $info['end'])->toDateTimeString(),
                    'user_id' => $user->id
                ]);

                $line++;
            }  
        }catch(Exception $e){
            return redirect()->route('events.index')
                        ->with('error','Falha ao importar arquivo. linha:'.$line);
        }
        

        return redirect()->route('events.index')
                        ->with('success','Lista de Eventos Importadas com Sucesso.');
    }
}
