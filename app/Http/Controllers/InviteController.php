<?php

namespace App\Http\Controllers;

use App\Invite;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class InviteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'event_id'  => 'required',
            'status'    => 'required',
            'email'     => 'required|email'
        ]);

        // Check if the email already existis
        $invite = Invite::where('email', $request->input('email'))->first();

        // If email does not exists, create a new record
        // Else, update the one that exists
        if(empty($invite)) {
            $invite = new Invite;
        }

        $invite->event_id = Invite::decryptId($request->input('event_id'));
        $invite->email = $request->input('email');
        $invite->status = $request->input('status');

        return response()->json($invite->save());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invite  $invite
     * @return \Illuminate\Http\Response
     */
    public function show(Invite $invite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Invite  $invite
     * @return \Illuminate\Http\Response
     */
    public function edit(Invite $invite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invite  $invite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invite $invite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invite  $invite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invite $invite)
    {
        //
    }
}
