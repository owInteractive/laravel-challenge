<?php

namespace App\Http\Controllers;

use App\Event;
use App\Invite;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class InviteController extends Controller
{
    public function __invoke(Request $request, Event $event)
    {
        if($event->user_id == Auth::user()->id) {
            $validator = Validator::make($request->all(), [
                'event' => 'required|exists:events,id',
                'name' => 'required',
                'email' => 'required|email',
                'description' => 'required'
            ]);

            if ($validator->fails()) {
                return redirect('events')
                    ->withErrors($validator)
                    ->withInput();
            } else {
                Invite::create([
                    'event_id' => $request->event,
                    'name' => $request->name,
                    'email' => $request->email,
                    'message' => $request->message,
                ]);

                // TODO: Send e-mail

                Session::flash('message', 'Invitation sent successfully!');
                return Redirect::to('events');
            }
        }
    }
}
