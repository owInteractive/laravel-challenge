<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function index()
    {        
        $title = 'Profile';
        $user = Auth::user();
        return view('profile', compact('title', 'user'));
    }

    public function updateAccount(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:35',
        ]);
        
        $user = Auth::user();
        
        if (isset($request->password)) {
            $this->validate($request, [
                'password' => 'required|string|min:6|confirmed',
            ]);

            $user->password = bcrypt($request->password);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('profile');
    }

}