<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
        return view('user.index');
    }

    public function update(Request $request){
        $user = User::find(\Auth::user()->id);
        $this->validate($request, [
            'name' => 'required|max:191',
            'email' => [
                'required',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => 'required_with:password_confirmation|same:password_confirmation|string|min:6|max:191',
            'password_confirmation' => 'min:6'
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));

        return response()->json($user->save());
    }
}
