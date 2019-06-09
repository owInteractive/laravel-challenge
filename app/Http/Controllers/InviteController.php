<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendInvites;

class InviteController extends Controller
{
  public function invite($event_id)
  {
    $event = Event::findOrFail($event_id);
    return view('event.invite', compact('event'));
  }
  public static function mail(Request $request, $event_id)
  {
    $emails = explode(',', preg_replace('/\s*/m', '', $request->emails));
    foreach ($emails as $email) {
      Mail::to($email)->send(new SendInvites($event_id));
    }
    return redirect('/event')->with('success', 'Invites sent with success');
  }
}
