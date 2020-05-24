<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function profile()
    {
        $user = User::all()->where('id', Auth::id())->first();
        return view('user.profile', compact('user'));
    }

    public function updateDetails(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        $user = Auth::user();

        $user->name = $request->name;
        $user->email = $request->email;

        if ($user->save())
            return redirect('profile')->with('success', 'user.update.success');
        return redirect('profile')->with('error', 'user.update.error');
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|string|min:6|confirmed',
            'old_password' => 'required|string|min:6',
        ]);
        if (!Hash::check($request['password'], Auth::user()->password)) {
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }
        if(strcmp($request['old_password'], $request['password']) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }
        $user = Auth::user();
        $user->password = Hash::make($request['password']);
        $user->save();
            return redirect('profile')->with('success', 'Password updated successfully');
    }
}
