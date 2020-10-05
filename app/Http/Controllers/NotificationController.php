<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notification;
use App\User;
use App\Event;
use Illuminate\Http\JsonResponse;


class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifications = Notification::where('user_id', Auth::user()->id)->get();
        foreach($notifications as $notif) {
            $user = User::where('id' ,$notif->from)->first();
            $notif->from = $user->name;
        }
        return $notifications; 
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
        $user = User::where('email' ,$request->mail)->first();
        $event = Event::where('id',$request->eventId)->first();
        if(!$user) return response()->json(['error' => 'user not found'],404);
        if($user->id == Auth::user()->id) return response()->json(['error' => 'you cant invite yourself'],500);
        $notificatios = Notification::where('user_id', $user->id)->get();
        foreach($notificatios as $notif) {
            if($notif->event_id == $event->id)
                return response()->json(['error' => 'this user alrdy invited to this event'],500);
        }
        $notif = new Notification([
            'user_id' => $user->id,
            'from' =>Auth::user()->id,
            'event_id' => $request->eventId,
            'event_name' => $event->title
        ]);
        $notif->save();
        return $notif;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notif = Notification::find($id);
        $notif->delete();
        return response()->json(['message' => 'notification deleted succefully'],200);
    }
}
