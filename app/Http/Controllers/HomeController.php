<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Presence;
use App\Models\User;
use DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /***METODO CONSTRUTOR */
    private $event;
    private $presence;
    private $user;
    private $login;


    public function __construct(Event $event, Presence $presence,User $user)
    {
        /**inicia variarveis */
        $this->middleware('auth');
        $this->event = $event;
        $this->presence =$presence;
        $this->user = $user;
        $this->login = Auth::user();
    }

    
    public function index()
    {
        //EVENTOS CRIADOS POR MIN
        $my= DB::table('events')
                            ->where('events.owner',Auth::user()->id)->get();
         $my = count($my);
        ///EVENTOS QUE EU FUI CONVIDADO
         $invites = DB::table('events')
                                ->join('presences', 'events.id', '=', 'presences.id_event')
                                ->where('presences.id_user',Auth::user()->id)
                                ->where('presences.invite_status','Aguardando Resposta')->get(); 
         $invitesdet = $invites;
         $invitescount = count($invites);  

         ////EVENTOS EM 5 DIAS
         $now = date('Y-m-d H:i:s');
         
         $fivedays = DB::table('events')
                                ->where('start','>=',$now)
                                ->where('start','<=',date('Y-m-d H:i:s', strtotime(' + 5 days')))
                                ->get();

        $fivedays = count($fivedays); 
        
        ////EVENTOS HOJE
        $today = DB::table('events')
                                    ->whereBetween('start', [date('Y-m-d', strtotime('- 1 day')),date('Y-m-d', strtotime('+ 1 day'))])
                                    ->get();
        $today = count($today); 

        ////TODOS EVENTOS
        $all = DB::table('events')
                                    ->get();
        $all = count($all); 



        
        return view('home',compact('my','invites','today','fivedays','all','invitesdet','invitescount'));
    }
}
