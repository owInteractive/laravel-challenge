<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Presence;
use App\Http\Requests\EventFormRequest;

class EventController extends Controller
{
    ///METODO CONSTRUTO EVENTO  
    private $event;
    private $presence;
    private $totalPage = 10;
   
 
    public function __construct(Event $event, Presence $presence)
    {
         $this->event = $event;
         $this->presence =$presence;
        
    }
 
     ///HOME PAGE DE EVENTOS
     public function index($search="")
 
     {   
         $busca = $search;
         $buscavalor = "%$search%";
        
         $events = $this->event->where('title','like',$buscavalor)->paginate($this->totalPage);
        
         return view('list-event',compact('events','busca'));
     }
 
     ///FUNÇÃO ARMAZENAR evento
     public function store(EventFormRequest $request)
     {
         $dataForm =  $request->except(['_token']);
          
        $insert =  $this->event->create($dataForm); 
        if($insert)
             return redirect()
                         ->route('event.index')
                         ->with('message_sucesso', 'The Event have saved sucessfuly!');
         else
             return redirect()->back()->withInput();
     }
 
     ///FORMULARIO DE CADASTRO DE EVENTOS
     public function create()
     {
         $title = 'Create New Event';
         $owner = -100;
         return view('form-event',compact('title','owner'));
     }
 
 
     ///FUNÇÃO DE ATUALIZAR EVENTO
     public function update(EventFormRequest $request, $id)
     {
         $dataForm =  $request->all();   
         $event =  $this->event->find($id);
        /* /*dd($dataForm);*/
        $update =  $event->update($dataForm);
             if($update)
                 return redirect()
                             ->back()
                             ->with('message_sucesso', "{$event->title} updated with sucess!");
             else    
                 return redirect()->back();
             
            
                
     }
    
     //FORMULÁRIO PARA EDIÇÃO DO EVENTO
     public function edit($id,$user="xx")
     {
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
         
         
      
         return view('form-event',compact('event','title','stats','owner'));
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
        $event =  $this->event->find($id);
        $presence = $this->presence->where('id_event','=',$id)
                                    ->where('id_user','=',$user);
        
        $title = "{$event->title}";
     
        return view('form-event',compact('event','title','presence'));
     }
    
 
}
