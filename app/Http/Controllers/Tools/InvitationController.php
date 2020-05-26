<?php

namespace App\Http\Controllers\Tools;

use App\Models\Event;
use App\Models\Invite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class InvitationController extends Controller
{
    public function index()
    {
        $invites = Invite::all()->where('user_id', Auth::id());
        return view('invite.index', compact('invites'));
    }
    public function hash($id)
    {
        $str = $id . random_bytes(8);
        return bin2hex($str);
    }
    public function create($id)
    {
        $hash = $this->hash($id);
        $invite = Invite::create([
            'user_id' => 1,
            'event_id' => $id,
            'hash' => $hash
        ]);
        return response()->json([
            "data" => $invite
        ],200);
    }

    public function getEventId($hash)
    {
        return Invite::all()->where('hash', $hash)->first()->event_id;
    }
    public function getEventDetails($hash)
    {
        $id = $this->getEventId($hash);
        return Event::find($id)->toArray();
    }
    public function participate($hash)
    {
        $event = $this->getEventDetails($hash);
        dd($event);
    }

}
