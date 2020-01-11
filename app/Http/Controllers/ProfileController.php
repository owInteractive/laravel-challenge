<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function index()
    {
        return view('profile.index');
    }

    public function update(Request $request)
    {

        /** @var User $user */
        $user = Auth::user();

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Your profile has been updated successfully.');

    }

    public function updatePassword(Request $request)
    {

        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            return redirect()
                ->back()
                ->withErrors('Your current password do not match with the password you provided. Please try again.');
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            return redirect()
                ->back()
                ->withErrors('Your new password cannot be same as your current password. Please choose a different password.');
        }

        $this->validate($request, [
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);

        /** @var User $user */
        $user = Auth::user();

        $user->update([
            'password' => bcrypt($request->get('new-password')),
        ]);

        return redirect()
            ->back()
            ->with("success", "Your password has been changed successfully.");

    }

}
