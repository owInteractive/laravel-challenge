<?php

namespace App\Http\Controllers\Tools;

use App\Models\Event;
use App\Models\Invite;
use App\Models\UserEvents;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            'user_id' => Auth::id(),
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
        if(DB::table('user_events')->where([
            ['user_id', '=', Auth::id()],
            ['event_id', '=', $event['id']]
        ])->get()->count() == 0)
        {
            $user_events = UserEvents::create([
                'user_id' => Auth::id(),
                'event_id' => $event['id'],
                'is_owner' => false
            ]);
            return response()->json([
                'data' => $user_events
            ], 200);
        }
        return response()->json([
            'message' => "You're already participating in this event!"
        ]);
    }
}
