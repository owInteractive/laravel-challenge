<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Presence;
use App\Models\User;
use App\Http\Requests\EventFormRequest;
use DB;
use App\Quotation;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    ///METODO CONSTRUTO EVENTO  
    private $event;
    private $presence;
    private $user;
    private $totalPage = 10;
   

    
 
    public function __construct(Event $event, Presence $presence,User $user)
    {
        $this->middleware('auth');
         $this->event = $event;
         $this->presence =$presence;
         $this->user = $user;

         
        
    }
 
     ///HOME PAGE DE EVENTOS
     public function index($search="")
 
     {   
         ///EVENTOS QUE EU FUI CONVIDADO
         $invites = DB::table('events')
                                ->join('presences', 'events.id', '=', 'presences.id_event')
                                ->where('presences.id_user',Auth::user()->id)
                                ->where('presences.invite_status','Aguardando Resposta')->get(); 
         $invitesdet = $invites;
         $invitescount = count($invites); 

         $busca = $search;
         
         $buscavalor = "%$search%";
        
         $events = $this->event->where('title','like',$buscavalor)->paginate($this->totalPage);
         $title = 'All Events';
         return view('list-event',compact('events','busca','title','invitesdet','invitescount'));
         
     }
     ///MEUS CONVITES
     public function invites($id,$search="")
 
     {   
        ///EVENTOS QUE EU FUI CONVIDADO
        $invites = DB::table('events')
        ->join('presences', 'events.id', '=', 'presences.id_event')
        ->where('presences.id_user',Auth::user()->id)
        ->where('presences.invite_status','Aguardando Resposta')->get(); 
$invitesdet = $invites;
$invitescount = count($invites); 
         
         $busca = $search;
         $buscavalor = $search;
         if($buscavalor==' ' or $buscavalor == null)
         {
             $buscavalor='%%';
         }
         else{
         $buscavalor = "%$search%";
         }
         $events = DB::table('events')
         ->join('presences', 'events.id', '=', 'presences.id_event')
         ->where('title', 'like', $buscavalor)
         ->where('presences.id_user',$id)
         ->paginate($this->totalPage);      
         $title = 'My Invites';  
                
         return view('list-invites',compact('events','busca','title','id','invitesdet','invitescount'));
     }
     ///MEUS CONVITES PENDENTES
     public function pinvites($id,$search="")
 
     {   
        ///EVENTOS QUE EU FUI CONVIDADO
        $invites = DB::table('events')
        ->join('presences', 'events.id', '=', 'presences.id_event')
        ->where('presences.id_user',Auth::user()->id)
        ->where('presences.invite_status','Aguardando Resposta')->get(); 
$invitesdet = $invites;
$invitescount = count($invites); 
         
         $busca = $search;
         $buscavalor = $search;
         if($buscavalor==' ' or $buscavalor == null)
         {
             $buscavalor='%%';
         }
         else{
         $buscavalor = "%$search%";
         }
         $events = DB::table('events')
         ->join('presences', 'events.id', '=', 'presences.id_event')
         ->where('title', 'like', $buscavalor)
         ->where('presences.id_user',$id)
         ->where('presences.invite_status','Aguardando Resposta')
         ->paginate($this->totalPage);      
         $title = 'My Pending Invites';  
                
         return view('list-invites',compact('events','busca','title','id','invitesdet','invitescount'));
     }
     ///MEUS EVENTOS
     public function my($id,$search="")
 
     {   
       ///EVENTOS QUE EU FUI CONVIDADO
       $invites = DB::table('events')
       ->join('presences', 'events.id', '=', 'presences.id_event')
       ->where('presences.id_user',Auth::user()->id)
       ->where('presences.invite_status','Aguardando Resposta')->get(); 
$invitesdet = $invites;
$invitescount = count($invites); 

         $busca = $search;
         $buscavalor = $search;
         if($buscavalor==' ' or $buscavalor == null)
         {
             $buscavalor='%%';
         }
         else{
         $buscavalor = "%$search%";
         }
         $events = DB::table('events')->where('title', 'like', $buscavalor)
         ->Where('owner','=',$id)
         ->paginate($this->totalPage);      
         $title = 'My Events';    
         return view('list-event',compact('events','busca','title','invitesdet','invitescount'));
     }
     ///5 DIAS 
     public function fivedays($search="")
 
     {   
        $invitesdet = $this->invitesdet;
        $invitescount = $this->invitescount;

         $buscavalor = $search;
         $busca = $search;
         if($buscavalor==' ')
         {
             $buscavalor='%%';
         }
         else{
         $buscavalor = "%$search%";
         }
         $now = date('Y-m-d H:i:s');
         
         $title = 'Next 5 days';
         $events = $this->event->where('title','like',$buscavalor)
                                ->where('start','>=',$now)
                                ->where('start','<=',date('Y-m-d H:i:s', strtotime(' + 5 days')))
                                ->paginate($this->totalPage);

                               
           
         return view('list-event',compact('events','busca','title','invitesdet','invitescount'));
   
     }
     ///hoje
     public function today($search="")
 
     {   
        ///EVENTOS QUE EU FUI CONVIDADO
        $invites = DB::table('events')
        ->join('presences', 'events.id', '=', 'presences.id_event')
        ->where('presences.id_user',Auth::user()->id)
        ->where('presences.invite_status','Aguardando Resposta')->get(); 
$invitesdet = $invites;
$invitescount = count($invites); 

        $buscavalor = $search;
        $busca = $search;
        if($buscavalor ==' ' or $buscavalor == null)
        {
            $buscavalor='%%';
        }
        else{
        $buscavalor = "%$search%";
        }
        $now = date('Y-m-d');
        $events = DB::table('events')->where('title', 'like', $buscavalor)
         ->whereBetween('start', [date('Y-m-d', strtotime('- 1 day')),date('Y-m-d', strtotime('+ 1 day'))])
         
         ->paginate($this->totalPage);   
        $title = 'Today Events';
         return view('list-event',compact('events','busca','title','invitesdet','invitescount'));
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
       ///EVENTOS QUE EU FUI CONVIDADO
       $invites = DB::table('events')
       ->join('presences', 'events.id', '=', 'presences.id_event')
       ->where('presences.id_user',Auth::user()->id)
       ->where('presences.invite_status','Aguardando Resposta')->get(); 
$invitesdet = $invites;
$invitescount = count($invites); 

        $users = $this->user->where('email','<>','')->paginate($this->totalPage);
       
         $title = 'Create New Event';
         $owner = -100;
         $event = $this->event;
         $stats = 'Nulo';
         return view('form-event',compact('title','owner','event','stats','invitesdet','invitescount','users'));
     }
 
 
     ///FUNÇÃO DE ATUALIZAR EVENTO
     public function update(EventFormRequest $request, $id)
     {
         $dataForm =  $request->all();   
         $event =  $this->event->find($id);
        
        $update =  $event->update($dataForm);
             if($update)
                 return redirect()
                             ->back()
                             ->with('message_sucesso', "{$event->title} updated with sucess!");
             else    
                 return redirect()->back();
             
            
                
     }
    
     //FORMULÁRIO PARA EDIÇÃO DO EVENTO
     public function edit($id,$user)
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
         return ($stats."\n".$user."\n");
         
        /* 
      
         return view('form-event',compact('event','title','stats','owner','invitesdet','invitescount'));*/
     }
     //FORMULÁRIO PARA EDIÇÃO DO EVENTO
     public function exibe($id,$user)
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
         $stats =''; //inicializando variavel
        
         $stats = $this->presence->where('id_user',$user)->where('id_event',$id)->value('invite_status');
      
         $invites = $this->presence->where('id_event',$id)->get();

         $users = $this->user->where('email','<>','')->paginate($this->totalPage);
         $owner = $event->owner;
        
         if(!$owner)
         {
             $owner = 0;
         }
         
         if($stats == '')
         {
             $stats = 'Nulo';
         }
         
       return view('form-event',compact('event','title','stats','owner','invites','users','invitesdet','invitescount'));
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

     ///FORMULARIO DE IMPORTAR EXCEL
     public function excelform()
     {   
        ///EVENTOS QUE EU FUI CONVIDADO
        $invites = DB::table('events')
        ->join('presences', 'events.id', '=', 'presences.id_event')
        ->where('presences.id_user',Auth::user()->id)
        ->where('presences.invite_status','Aguardando Resposta')->get(); 
$invitesdet = $invites;
$invitescount = count($invites); 
            
        $title = "Import here your CSV File";
     
        return view('form-event-csv',compact('title','invitesdet','invitescount'));
     }
     ///IMPORTAR EXCEL PARA O BANCO
     public function excelImport(Request $request)
     {       
       
       
        
        $insert =false;
        $manage = json_decode($request->input('campos')[0], true);
        $cont = 0;
        $rows = count($manage);
        $continsert=0;
        while( $cont < $rows){
        

           
            $event = new Event();
    
            $event->title = $manage[$cont]['title'];
            $event->description = $manage[$cont]['description'];
            $event->start = date('Y-m-d H:i', strtotime($manage[$cont]['start']));
            $event->end = date('Y-m-d H:i', strtotime($manage[$cont]['end']));
            $event->owner = $manage[$cont]['owner']; 
    
            $insert = $event->save();
            if($insert)
                $continsert++;
        $cont++;
        }
        if($insert)
             return redirect()
                         ->route('event.index')
                         ->with('message_sucesso', ''.$continsert.' Events imported via CSV !');
         else
             return redirect()->back()->withInput();
        return ('');
     }
    
    ///EXPORTAR EXCEL DO  BANCO
    public function exportExcel($id,$category,$search = " ")
    {
        $buscavalor = $search;
        
         if($buscavalor ==' ' or $buscavalor == null)
         {
             $buscavalor='%%';
             $busca ='%%';
         }
         else{
         $buscavalor = "%$search%";
         $busca =$search;
         }
         $now = date('Y-m-d H:i:s');

         if($category == 'Today Events')
         {
            $events = DB::table('events')->where('title', 'like', $buscavalor)
            ->whereBetween('start', [date('Y-m-d', strtotime('- 1 day')),date('Y-m-d', strtotime('+ 1 day'))])->get();
         }
         else{
            if($category == 'Next 5 days')
            {
               $events = $this->event->where('title','like',$buscavalor)
                                      ->where('start','>=',$now)
                                      ->where('start','<=',date('Y-m-d H:i:s', strtotime(' + 5 days')))->get();
            }
            else {
                if($category == 'My Events')
                {
                    $events = DB::table('events')->where('title', 'like', $buscavalor)
                    ->Where('owner','=',$id)->get();    
            
                }
                else {
                    if($category == 'All Events')
                    {
                        $events = $this->event->where('title','like',$buscavalor)->get();
                        
                    }
                    else
                    {
                        if($category == 'My Invites')
                        {
                            $events = DB::table('events')
                                        ->join('presences', 'events.id', '=', 'presences.id_event')
                                        ->where('title', 'like', $buscavalor)
                                        ->where('presences.id_user',$id)
                                        ->paginate($this->totalPage); 
                            
                        }
                        else
                        {

                            if($category == 'My Pending Invites')
                            {
                                $events = DB::table('events')
                                ->join('presences', 'events.id', '=', 'presences.id_event')
                                ->where('title', 'like', $buscavalor)
                                ->where('presences.id_user',$id)
                                ->where('presences.invite_status','Aguardando Resposta')
                                ->paginate($this->totalPage); 
                                
                            }

                                

                        }
                    }
                }
            }
         }
         
        
         

        $headers = array(
            "Content-type" => "text/csv ;",
            "Content-Disposition" => "attachment; filename=file.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );
    
       
        $columns = array('Title', 'Description', 'Start', 'End');
    
        $callback = function() use ($events, $columns)
        {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
    
            foreach($events as $event) {
                fputcsv($file, array($event->title, $event->description, $event->start, $event->end));
            }
            fclose($file);
        };
      return Response::stream($callback, 200, $headers);
      
    }
}
