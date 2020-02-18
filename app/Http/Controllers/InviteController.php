<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Mail;
use App\Mail\Invite;

class InviteController extends Controller
{
    protected $eventModel;

    public function __construct(Event $eventModel)
    {
        $this->eventModel = $eventModel;
    }

    public function invite($event_id)
    {
        $event = $this->eventModel->findOrFail($event_id);
        return view('events.invite', compact('event'));
    }

    public static function mail(Request $request, $event_id)
    {
        $emails = explode(',', preg_replace('/\s*/m', '', $request->emails));
        foreach ($emails as $email) {
            Mail::to($email)->send(new Invite($event_id));
        }
        return redirect()->route('events.index')->with('success', 'Invite(s) sent!');
    }
  }
