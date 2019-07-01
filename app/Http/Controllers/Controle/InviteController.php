<?php

namespace App\Http\Controllers\Controle;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Invitation;
use App\Models\Event;
use App\Models\EventUser;
use Auth;

class InviteController extends Controller
{
 
    public function accept($token)
    {
        $invite = Invitation::whereToken($token)->first();
        $event  = Event::withoutGlobalScopes()->with('user')->where('id', $invite->event_id)->first();

        if (!isset($invite->id)) {
            return view('error-invite');
        }
         
        return view('accept-invite', compact('invite', 'event'));
       
    }

    public function accepting($token)
    {
        try {
            $invite = Invitation::whereToken($token)->whereEmail(Auth::user()->email)->first();

            if (!isset($invite->id)) {
                return view('error-invite');
            }

            EventUser::updateOrCreate([
                'event_id'      => $invite->event_id,
                'invitation_id' => $invite->id,
            ],
            [
                'event_id'      => $invite->event_id,
                'invitation_id' => $invite->id,
                'user_id'       => Auth::id(),
                'accept'        => 1
            ]);
            
            session()->flash('event_id', $invite->event_id);

            return redirect()->route('controle.event.index')->with('msg', 'You are participating in the event!');

        } catch (\Exception $e) {
            return redirect()->route('controle.event.index')->with('msg', 'Error')->with('error', true);
        }
    }

}
