<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserController extends Controller
{
    public function myProfile(){
        UserController::verifyAuthIDExists();

        $user = User::findOrFail(Auth::id());
        return view('users.myprofile', compact('user'));
    }
    
    public function updateUser (Request $request, $user){
        $validator = Validator::make($request->all(), UserController::rulesUser($user));

        UserController::verifyAuthIDExists();
      
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        
        $localUser = User::findOrFail($user);

        $localUser->name = $request->name;
        $localUser->email = $request->email;
        $localUser->password = bcrypt($request->password);
        $localUser->save();
        return redirect()->back()->with('message', 'Success! User was updated.');
    }

    public function destroyUser($user){
        UserController::verifyAuthIDExists();
        $localUser = User::findOrFail($user);
        $localUser->delete();
        return redirect()->route('home')->with('error', 'User was deleted.');
    }

    public function verifyAuthIDExists(){
        if (!Auth::id()){
            return view('home');
        }
        return;
    }

    public function rulesUser($email){
        return [
            'name' => 'required|string|max:250',
            'email' => 'required|string|email|max:250|unique:users,email,'.$email,
            'password' => 'required|string|min:6|confirmed',
        ];
    }
}
