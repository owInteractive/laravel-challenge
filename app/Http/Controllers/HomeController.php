<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * show password update view
     */
    public function showChangePasswordForm()
    {
        return view('auth.passwords.change-password');
    }

    /**
    * password update method
    */
    public function changePassword(Request $request)
    {
        if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {

            return redirect()->back()->with(
                "error",
                "Your current password does not match the password you provided. Please try again."
            );
        }
        if (strcmp($request->get('current_password'), $request->get('new_password')) == 0) {

            return redirect()->back()->with(
                "error",
                "The new password cannot be the same as your current password. Please choose a different password."
            );
        }
        $validatedData = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:6|confirmed',
        ]);
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new_password'));
        $user->save();
        return redirect()->back()->with("success", "Password changed successfully!");
    }

    
    public function myAccount(Request $request)
    {
        $user = Auth::user();
        if ($request->isMethod('post')) {
            //dd($request->all());
            $this->validate($request, [
                'name' => ['required', 'string', 'max:255'],
                'mobile' => ['required', 'string', 'max:15', 'min:15'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id]
            ]);

            $user->fill($request->all());
            $user->save();
            return redirect()->back()->with("success", "Update successful");
        } else {
            return view('auth.account')->with('user', $user);
        }
    }
}
