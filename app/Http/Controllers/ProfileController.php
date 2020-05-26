<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class ProfileController extends Controller
{
    public function profile() {
        $user = User::find(Auth::user()->id);

        return view('profiles.profile', ['user' => $user]);
    }

    public function editProfile(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
        ]);

        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        
        $data = array(
            'name' => $user->name,
            'email' => $user->email
        );
        User::where('id', Auth::user()->id)->update($data);
        $user->update();
        return redirect()->back()->with('success', 'User updated successfully');
    }
    
}
