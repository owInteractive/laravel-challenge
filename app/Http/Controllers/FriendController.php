<?php

namespace App\Http\Controllers;

use App\Friend;
use Illuminate\Http\Request;
use Auth;

class FriendController extends Controller
{
    
    public function index()
    {
        $friends = Friend::where('user_id', Auth::user()->id)->paginate(5);
        return view('friends.friend', ['friends' => $friends]);
    }

    public function add()
    {
        return view('friends.add');
    }

    public function addFriend(Request $request)
    {
        
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required'
        ]);
        
        
        $friend = new Friend;
        $friend->user_id = Auth::user()->id;
        $friend->email = $request->input('email');  
        $friend->name = $request->input('name');
        $friend->save();

        return redirect('friend')->with('response', 'Amigo adicionado com sucesso!');

    }

    public function edit($friend_user_id, $friend_email)
    {
        $friend = Friend::where('user_id', $friend_user_id)
                        ->where('email', $friend_email)
                        ->first();
        return view('friends.edit', ['friend' => $friend ]);
    }

    public function editFriend(Request $request, $email) {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required'
        ]);
        
        $friend = new Friend;
        $friend->user_id = Auth::user()->id;
        $friend->email = $request->input('email');  
        $friend->name = $request->input('name');

        $data = array(
            'user_id' => $friend->user_id,
            'email' => $friend->email,
            'name' => $friend->name,
        );

        Friend::where('user_id', $friend->user_id)
                        ->where('email', $friend->email)
                        ->update($data);
        $friend->update();

        return redirect('/friend')->with('response', 'Amigo atualizado com sucesso');     
    }

    public function deleteFriend($friend_user_id, $email) {
        Friend::where('user_id', $friend_user_id)
                        ->where('email', $email)
                        ->delete();
        
        return redirect('/friend')->with('response', 'Amigo deletado com sucesso');     
    }

    
}
