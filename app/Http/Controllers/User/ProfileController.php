<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = auth()->user();

        return view('users.profile.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProfileRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileRequest $request)
    {
        $user = auth()->user();

        if ($request->has('new_password') && !Hash::check($request->get('new_password'), $user->password)){
            $request['password'] = Hash::make($request->get('new_password'));
        } else {
            unset($request['password']);
        }

        $user->update($request->all());

        return redirect()->back()->with('success', 'Profile updated!');
    }
}
