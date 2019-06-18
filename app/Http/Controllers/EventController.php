<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Exports\EventsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Imports\EventsImport;
use App\Event;
use Mail;

class EventController extends Controller
{
    function __construct()
    {
        date_default_timezone_set('America/Sao_Paulo');
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('event.createEvent');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $event = new Event;
        $event = $request->all();
        $event['user_id'] = Auth::user()->id;
        Event::create($event);
        return redirect()->route('home');
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
        $event = (Object)$event;
        return view ('event.updateEvent')->with('event',$event);
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
        $event = $request->all();
        Event::find($id)->update($event);
        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Event::find($id)->delete();
        return redirect()->route('home');
    }

    public function nowDay()
    {
        $dataAtual = date("Y-m-d");         
        $event = DB::table('events')
        ->select('*')
        ->where('user_id',Auth::user()->id)
        ->where('deleted_at',null)
        ->where('dataInicio',$dataAtual)
        ->get();
        $response = json_encode($event);
        return response()->json($response);
    }

    public function nextDay()
    {
        $dataAtual = date("Y-m-d"); 
        $dataNext = date('Y-m-d', strtotime("+5 days",strtotime($dataAtual)));
        $event = DB::table('events')
        ->select('*')
        ->where('user_id',Auth::user()->id)
        ->where('deleted_at',null)
        ->where("dataInicio",">=",$dataAtual)
        ->where("dataInicio","<=",$dataNext)
        ->orderBy('dataInicio','asc')
        ->get();
        $response = json_encode($event);
        return response()->json($response);
    }

    public function export(){
                    
        return Excel::download(new EventsExport, 'events.csv');
    }

    public function import(Request $request)
    {
        Excel::import(new EventsImport, request()->file('import_file'));
        return redirect()->route('home');
    }

    public function mail(Request $request){
        $dados = $request->all();
        $event = Event::find($dados['id']);
        $event = (Object)$event;
        $event->nome= Auth::user()->name;
        $dados = $request->all();
        $mails = explode(',',$dados['emails']);
        foreach ($mails as $key => $email) {
        if(filter_var($email, FILTER_VALIDATE_EMAIL) == false){
            unset($mails[$key]);
        }
    }
            Mail::send('sendEmail', ['titulo' => $event->titulo,'descricao' =>$event->descricao,'dataInicio' => $event->dataInicio,'dataFim' => $event->dataFim,'nome' => $event->nome], function ($m) use($mails) { 
                $m->from('testevento2009@gmail.com','Evento');
                $m->subject("Convite para Evento");
                foreach ($mails as $ml) {
                    $m->to($ml);
                }
        });      
        return redirect()->route('home');
        }

}