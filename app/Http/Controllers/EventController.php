<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Http\Requests\EventRequestStore;
use \App\Models\Event;
use Carbon\Carbon;


class EventController extends Controller
{
    public function index(Request $request)
    {   if($request->nexts_days != ''){
  
        $date =  $this->intervalCurrentDate($request->nexts_days);
       // return $date;
        //return date('Y-m-d').' 00:00:00';
        return   \DB::table('events')->where([
                                    ['event_start', '>=', date('Y-m-d').' 00:00:00'],
                                    ['event_start', '<=', $date.' 23:59:59'],
                                ])->get();

        }else{
            return Event::all();
        }
        
    }

    public function create(Request $request)
    {
        //
    }
    public function store(EventRequestStore $request)
    {
        return Event::create(
            ['title'=>$request->title,
                'description'=>$request->description,
                'event_start'=>$request->event_start,
                'event_end'=>$request->event_end,
                'user_id'=>auth()->user()->id,
            ]);
    }

    public function show($id)
    {
        return Event::find($id);
    }
    public function edit($id)
    {
        return false;
    }
    public function update(Request $request, $id)
    {
        
        $updateEvent = Event::find($id);
        $updateEvent->title       = $request->title;
        $updateEvent->description = $request->description;
        $updateEvent->event_start = $request->event_start;
        $updateEvent->event_end   = $request->event_end;

        $returUpdate =  $updateEvent->save();

        if($updateEvent->save()){
            return response()->json([
              'status'=>true,
              'msg'=>'Registro atualizado com sucesso!',
              'user'=>[
                       'name'=>$updateEvent->title,
                       'email'=>$updateEvent->description,
                       'event_start'=>$updateEvent->event_start,
                       'event_end'=>$updateEvent->event_end,
                       ]
            ]);

        }else{
            return response()->json([
                'status'=>false,
                'msg'=>'Erro ao atualizar registro! \n Tente novamente mais tarde.'
              ]);
            }


    }
    public function destroy($id)
    {
        $return  = (Event::destroy($id) == 1)?true:false;
        if($return){
            return response()->json(['status'=>true,'msg'=>'Registro Excluido com Sucesso!'],201);
        }else{
            return response()->json(['status'=>false,'msg'=>'Ocorreu um erro ao tentar excluir esse registo'],401);
        }
        
    }
    private function intervalCurrentDate($interval)
    {
        $date = date_create(date('Y-m-d'));
        date_add($date, date_interval_create_from_date_string($interval.' days'));
        return  date_format($date, 'Y-m-d');
    }
}
