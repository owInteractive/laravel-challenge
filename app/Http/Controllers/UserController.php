<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Presence;
use App\Models\User;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserFormRequest;

class UserController extends Controller
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
        
    }

    public function edit($id)
    {
        //EVENTOS QUE EU FUI CONVIDADO
        $invites = DB::table('events')
        ->join('presences', 'events.id', '=', 'presences.id_event')
        ->where('presences.id_user',Auth::user()->id)
        ->where('presences.invite_status','Aguardando Resposta')->get(); 
        $invitesdet = $invites;
        $invitescount = count($invites); 

        $user = $this->user->find(Auth::user()->id);

        return view ('form-user',compact('user','invitesdet','invitescount'));
        

    }
    ///FUNÇÃO DE ATUALIZAR USUARIO
    public function update(UserFormRequest $request, $id)
    {
        $dataForm =  $request->except('password');   
        $user =  $this->user->find($id);
        $user->password = bcrypt($request->get('password'));
        $user->save();
        $user =  $this->user->find($id);
        $update =  $user->update($dataForm);
            if($update)
                return redirect()
                            ->back()
                            ->with('message_sucesso', "updated with sucess!");
            else    
                return redirect()->back();
            
           
               
    }
}
