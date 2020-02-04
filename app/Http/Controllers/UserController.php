<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function edit(User $user)
    {
        $user = Auth::user();
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {   

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required'
        ]);

        if ($request->password != $request->password_confirmation) 
            return redirect()->route('users.edit')
                    ->with('error','The passwords does not match');
        
        if (Auth::user()->email != $request->email) {
            $user = User::where('email', $request->email)->first();

            if ($user) {
                return redirect()->route('users.edit')
                        ->with('error','This E-mail is aready register');
            }
        }

        $request->merge(["password" => bcrypt($request->password)]);
        User::where('id', auth()->user()->id)->update($request->except(['_token','password_confirmation']));

        return redirect()->route('users.edit')
                        ->with('success','Prodile updated successfully');

    }
}
