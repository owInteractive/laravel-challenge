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

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email'
        ]);

        $payload = ['name' => $request->name];

        /** @var User $user */
        $user = Auth::user();

        if ($user->email !== $request->email) {
            $this->validate($request, [
                'email' => 'unique:users',
            ]);
            $payload['email'] = $request->email;
        }

        try {

            $user->update($payload);

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors('Failed to update your profile. Please, try again.');
        }

        return redirect()
            ->back()
            ->with('success', 'Your profile has been updated successfully.');

    }

    public function updatePassword(Request $request)
    {

        /** @var User $user */
        $user = Auth::user();

        if (!(Hash::check($request->get('current-password'), $user->password))) {
            return redirect()
                ->back()
                ->withErrors('Your current password do not match with the password you provided. Please try again.');
        }

        $this->validate($request, [
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed|different:current-password',
        ]);

        try {

            $user->update([
                'password' => bcrypt($request->get('new-password')),
            ]);

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors('Failed to change your password. Please, try again.');
        }

        return redirect()
            ->back()
            ->with("success", "Your password has been changed successfully.");

    }

}
