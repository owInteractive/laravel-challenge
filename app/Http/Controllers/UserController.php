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
            ]
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');

        return response()->json($user->save());
    }
}
