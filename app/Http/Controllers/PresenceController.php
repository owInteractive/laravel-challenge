<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PresenceFormRequest;
use App\Models\Presence;
use Illuminate\Support\Facades\Auth;
use DB;


class PresenceController extends Controller
{
    ///METODO CONSTRUTOR PRESENCE  
    
    private $presence;
    private $totalPage = 10;
    
 
    public function __construct(Presence $presence)
    {
        $this->middleware('auth');
         $this->presence =$presence;
        
        
    }
 
     ///HOME PAGE DE PRESENCE
     public function index()
 
     {   
         
     }
 
     ///FUNÇÃO ARMAZENAR PRESENÇA
     public function store(PresenceFormRequest $request)
     {
         $dataForm =  $request->except(['_token']);
        $insert =  $this->presence->create($dataForm); 
        
        if($insert)
             return redirect()->route('eventShow',['id'=>$request->input('id_event'),'user'=>$request->input('id_user')])
                              ->with('message_sucesso', 'The Presence have confirmed !');
         else
             return redirect()->back()->withInput();
     }

     ///CONVIDAR ARMAZENAR PRESENÇA
     public function invite(PresenceFormRequest $request)
     {
         $dataForm =  $request->only(['invite_status','id_event','id_user']);
         
      $insert =  $this->presence->create($dataForm); 
        
        if($insert)
             return redirect()->route('eventShow',['id'=>$request->input('id_event'),'user'=>$request->input('id_user')])
                              ->with('message_sucesso', 'Friend Invited !');
         else
             return redirect()->back()->withInput();
     }
 
     ///FORMULARIO DE CADASTRO DE PRESENÇA
     public function create()
     {
         
     }
 
 
     ///FUNÇÃO DE ATUALIZAR EVENTO
     public function update(PresenceFormRequest $request,$type)
     {
        $dataForm =  $request->except(['_token','_method','owner','title','description','start','end']);
   
        
         $presence =  $this->presence->where('id_event','=',$request->input('id_event'))
                                     ->where('id_user','=',$request->input('id_user'));
      
       
        $update =  $presence->update($dataForm);
             if($update)
                 return redirect()
                             ->back()
                             ->with('message_sucesso', "Event {$type} with success!");
             else    
                 return redirect()->back();
             
            
                
     }
    
     //FORMULÁRIO PARA EDIÇÃO DO EVENTO
     public function edit($id,$user="xx")
     {
        ///EVENTOS QUE EU FUI CONVIDADO
        $invites = DB::table('events')
        ->join('presences', 'events.id', '=', 'presences.id_event')
        ->where('presences.id_user',Auth::user()->id)
        ->where('presences.invite_status','Aguardando Resposta')->get(); 
$invitesdet = $invites;
$invitescount = count($invites); 

         $event =  $this->event->find($id);
         $title = "Event - {$event->title}";
        
         $stats = $this->presence->where('id_event', $id)->where('id_user',$user)->value('invite_status');
         $owner = $event->owner;
        
         if(!$owner)
         {
             $owner = 0;
         }
         
         if(!$stats)
         {
             $stats = 'Nulo';
         }
         
         
      
         return view('form-event',compact('event','title','stats','owner','invitesdet','invitescount'));
     }
      ///FUNÇÃO DE DELETAR EVENTO
     public function destroy($id)
      {
          try
          {
             $event =  $this->event->find($id);
              $delete =  $event->delete();
             
              return redirect()
                             ->route('event.index')
                             ->with('message_sucesso', 'Event have been excluded!');
             
          }catch(Exception $e){
             
             return redirect()
                              ->route('event.index')
                             ->with('message_erro', '{$e}' );
          }
          
      }
 
       ///FUNÇÃO DE EXIBIR EVENTO
     public function show($id,$user)
     {
        ///EVENTOS QUE EU FUI CONVIDADO
        $invites = DB::table('events')
        ->join('presences', 'events.id', '=', 'presences.id_event')
        ->where('presences.id_user',Auth::user()->id)
        ->where('presences.invite_status','Aguardando Resposta')->get(); 
$invitesdet = $invites;
$invitescount = count($invites); 

        $event =  $this->event->find($id);
        $presence = $this->presence->where('id_event','=',$id)
                                    ->where('id_user','=',$user);
        
        $title = "{$event->title}";
     
        return view('form-event',compact('event','title','presence','invitesdet','invitescount'));
     }
    
}
