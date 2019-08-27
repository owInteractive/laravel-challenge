<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Carbon\Carbon;

class EventsController extends Controller
{

    public function index()
    {
        $data=Event::with('user')->get();
        return response()->json($data, 200);
    }

    public function owner()
    {
        $user=Auth::user();
        $data=Event::where('owner', '=', $user['id'])
                        ->with('user')
                        ->get();
        return response()->json($data, 200);
    }

    public function today()
    {
        $data=Event::where('start', '<', Carbon::now()->addDays(1)->format("Y-m-d"))
                        ->where(function ($query) {
                            $query  ->where('end', '>', Carbon::now()->format("Y-m-d"))
                                    ->orwhere(function ($query2) {
                                        $query2 ->where('start', '>=', Carbon::now()->format("Y-m-d"))
                                                ->whereNull('end');
                                    });
                        })
                        ->with('user')
                        ->get();
                        //dd($data->toSql());
                        //dd($data->getBindings());
        return response()->json($data, 200);
    }

    public function next()
    {
        $data=Event::where('start', '<', Carbon::now()->addDays(6)->format("Y-m-d"))
                        ->where(function ($query) {
                            $query  ->where('end', '>', Carbon::now()->addDays(1)->format("Y-m-d"))
                                    ->orwhere(function ($query2) {
                                        $query2 ->where('start', '>=', Carbon::now()->addDays(1)->format("Y-m-d"))
                                                ->whereNull('end');
                                    });
                        })
                        ->with('user')
                        ->get();
                        //dd($data->toSql());
                        //dd($data->getBindings());
        return response()->json($data, 200);
    }


    public function store(Request $request)
    {
        $requisicao=$request->isJson() ? $request->json()->all() : $request->all();
        if(empty($requisicao)) return response('Vazio', 204);

        $validator = Validator::make($requisicao,Event::$rules);
        if ($validator->fails()) { return  response()->json($validator->errors(), 400); }
        
        if(!empty($requisicao['start']))
            $requisicao['start']=$this->formato($requisicao['start']);

        $data=Event::create($requisicao);
        return response()->json($data, 201);
    }

    public function show(Event $event)
    {
        //
    }


    public function update(Request $request, Event $event)
    {
        $user=Auth::user();
        if($user['id']!=$event['owner']) return response()->json($user->name." não é o dono",403);
        
        $requisicao=$request->isJson() ? $request->json()->all() : $request->all();
        if(empty($requisicao)) return response('Vazio', 204);

        $validator = Validator::make($requisicao,Event::$rules);
        if ($validator->fails()) { return  response()->json($validator->errors(), 400); }

        if($requisicao['start']===false)$requisicao['start']=null;

        if(!empty($requisicao['start']))
            $requisicao['start']=$this->formato($requisicao['start']);
                
        $event->update($requisicao);
        return response()->json($event,200);
    }

    public function destroy(Event $event)
    {
        $user=Auth::user();
        if($user['id']!=$event['owner']) return response()->json($user->name." não é o dono",403);
        return response()->json($event->delete(), 204);
    }

    function formato($valor)
    {
        if((\DateTime::createFromFormat('Y-m-d H:i:s',$valor) === FALSE)&&(\DateTime::createFromFormat('Y-m-d H:i',$valor) === FALSE))
            return \Carbon\Carbon::createFromTimestamp(substr($valor,0,10))->toDateTimeString();
            else
            return $valor;
    }
}
