<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserController extends Controller
{
    public function myProfile(){

        if (!Auth::id()){
            return view('home');
        }

        $user = User::findOrFail(Auth::id());
        return view('users.myprofile', compact('user'));
    }
    public function update (Request $request, $id){
        $validator = Validator::make($request->all(), UserController::rules($request->id));
      
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }


        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect()->back()->with('message', 'Sucesso ao atualizar entrada!');
    }

    public function destroy($id){
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('home')->with('message', 'Sucesso ao excluir usuário!');
    }

    public function rules($email){
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$email,
            'password' => 'required|string|min:6|confirmed',
        ];
    }
}
