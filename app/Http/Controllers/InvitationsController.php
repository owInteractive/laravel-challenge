<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Carbon\Carbon;

class InvitationsController extends Controller
{

    public function index()
    {
        $user=Auth::user();
        $data=Invitations::wherehas('event', function ($query) use($user){
            $query->where('owner', '=', $user['id']);
        })->with('event')->get();
        return response()->json($data, 200);
    }


    public function store(Request $request)
    {
        $requisicao=$request->isJson() ? $request->json()->all() : $request->all();
        if(empty($requisicao)) return response('Vazio', 204);

        $validator = Validator::make($requisicao,Invitations::$rules);

        if ($validator->fails()) { return  response()->json($validator->errors(), 400); }
        
        if(!empty($requisicao['expiration']))
            $requisicao['expiration']=$this->formato($requisicao['expiration']);

        $data=Invitations::create($requisicao);
        return response()->json($data, 201);
    }


    public function show(Invitation $invitation)
    {

    }


    public function update(Request $request, Invitation $invitation)
    {
        $user=Auth::user();
        //if($user['id']!=$invitation['owner']) return response()->json($user->name." não é o dono",403);
        
        $requisicao=$request->isJson() ? $request->json()->all() : $request->all();
        if(empty($requisicao)) return response('Vazio', 204);

        $validator = Validator::make($requisicao,Invitations::$rules);
        if ($validator->fails()) { return  response()->json($validator->errors(), 400); }

        if($requisicao['expiration']===false)$requisicao['expiration']=null;

        if(!empty($requisicao['expiration']))
            $requisicao['expiration']=$this->formato($requisicao['expiration']);
                
        $invitation->update($requisicao);
        return response()->json($invitation,200);
    }


    public function destroy(Invitation $invitation)
    {
        $user=Auth::user();
        //if($user['id']!=$invitation['owner']) return response()->json($user->name." não é o dono",403);
        return response()->json($invitation->delete(), 204);
    }
}
