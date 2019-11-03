<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Mail\InviteCreated;
use App\Models\Invite;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class InviteController extends Controller
{
    /**
     * show the user a form with an email field to invite to event
     */
    public function invite($id)
    {

        $event = Event::find($id);

        return view('invitations.send', compact('event'));
    }

    /**
     * process the form submission and send the invite by email
     */
    public function process(Request $request)
    {
        do {
            //generate a random string using Laravel's str_random helper
            $token = str_random();
        } //check if the token already exists and if it does, try again
        while (Invite::where('token', $token)->first());

        $event = Event::find($request->event_id);

        $end = new Carbon($event->end);

        //create a new invite record
        $invite = Invite::create([
            'email' => $request->get('email'),
            'token' => $token,
            'event_id' => $event->id,
            'valid_until' => $end->addDay(-1)
        ]);

        // send the email
        Mail::to($request->get('email'))->send(new InviteCreated($invite, $event));

        // redirect back where we came from
        return redirect()
            ->back()->with(['success' => 'Invitation sent successfully']);
    }

    /**
     * here we will look for the invitation token sent provided in the URL
     */
    public function accept($token)
    { 
        $invitation = Invite::where('token', '=', $token)->first();

        $now = Carbon::now();

        $dateInvite = new Carbon($invitation->valid_until);
        
        if($now->lte($dateInvite) && $invitation->email == Auth::user()->email){

            $invitation->presence = true;
            
            $invitation->save();

            return redirect('/admin/dashboard/')->with(['success' => 'Invitation successfully accepted']);

        }else{
            return redirect('/admin/dashboard/')->withErrors(['Inconsistent data']);
        }

    }

    public function forMe(){

        $invitations = Invite::where('email', Auth::user()->email)->paginate();

        return view('invitations.me', compact('invitations'));

    }
}
