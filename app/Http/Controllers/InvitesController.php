<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Events;
use App\Models\EventsInvites;
use App\Mail\Invite;

class InvitesController extends Controller
{
    public function index($id_event){
        $title = 'Event Invites';
        $event = Events::find($id_event);
        $invites = EventsInvites::where('id_event', $id_event)->get();
        $confirmedInvites = EventsInvites::where('id_event', $id_event)->where('status', 1)->get();
        $refusedInvites = EventsInvites::where('id_event', $id_event)->where('status', 2)->get();
        return view('panel.invites', compact('title', 'invites', 'event', 'confirmedInvites', 'refusedInvites'));
    }

    public function sendInvite($id_event, Request $request){
        $this->validate($request, [
            'name' => 'required|string|max:50',
            'email' => 'required|string|max:150',
        ]);

        $invite = EventsInvites::submit($request, $id_event);

        \Mail::to($invite->email)->send(new Invite($invite));
        return redirect()->route('invite', ['id_event' => $id_event]);
    }

    public function confirm($id_invite, Request $request){

        EventsInvites::confirm($id_invite);
        $request->session()->flash('status', 'Invite Confirmed!');
        return redirect()->route('home');

    }

    public function refuse($id_invite, Request $request){

        EventsInvites::refuse($id_invite);
        $request->session()->flash('status', 'Invite Refused!');
        return redirect()->route('home');
        
    }

}
