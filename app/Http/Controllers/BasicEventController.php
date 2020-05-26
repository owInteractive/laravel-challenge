<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BasicEvent;
use App\Friend;
use App\EventFriend;
use Auth;

class BasicEventController extends Controller
{
    public function basicEvent() {
        $friends = Friend::where('user_id', Auth::user()->id)->get();
        return view('basic_events.basic_event', ['friends' => $friends]);
    }

    public function addBasicEvent(Request $request) {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        
        $basicEvent = new BasicEvent;
        $basicEvent->title = $request->input('title');
        $basicEvent->user_id = Auth::user()->id;
        $basicEvent->description = $request->input('description');
        $basicEvent->start_date = $request->input('start_date');
        $basicEvent->end_date = $request->input('end_date');
        $basicEvent->save();
        
        foreach($request->input('friends') as $friend_email) {
            $eventFriend = new EventFriend;
            $eventFriend->event_id = $basicEvent->id;
            $eventFriend->friend_user_id = Auth::user()->id;
            $eventFriend->friend_email = $friend_email;
            $eventFriend->save();
        }

        return redirect('/home')->with('response', 'Event added successfully');
        
    }

    public function edit($basicEvent_id) {
        $basicEvent = BasicEvent::find($basicEvent_id);
        $friends = Friend::where('user_id', Auth::user()->id)->get();

        return view('basic_events.edit', ['basicEvent' => $basicEvent, 'friends' => $friends]);
    }

    public function editBasicEvent(Request $request, $basicEvent_id) {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $basicEvent = new BasicEvent;
        $basicEvent->title = $request->input('title');
        $basicEvent->user_id = Auth::user()->id;
        $basicEvent->description = $request->input('description');
        $basicEvent->start_date = $request->input('start_date');
        $basicEvent->end_date = $request->input('end_date');
        
        $data = array(
            'title' => $basicEvent->title,
            'user_id' => $basicEvent->user_id,
            'description' => $basicEvent->description,
            'start_date' => $basicEvent->start_date,
            'end_date' => $basicEvent->end_date
        );
        BasicEvent::where('id', $basicEvent_id)->update($data);
        $basicEvent->update();

        $deleteEventFriends = EventFriend::where('friend_user_id', $basicEvent->user_id)
                                         ->where('event_id', $basicEvent_id)->delete();
        foreach($request->input('friends') as $friend_email) {
            $eventFriend = new EventFriend;
            $eventFriend->event_id = $basicEvent_id;
            $eventFriend->friend_user_id = Auth::user()->id;
            $eventFriend->friend_email = $friend_email;
            $eventFriend->save();
        }
        
        return redirect('/home')->with('response', 'Event updated successfully');     
    }

    public function deleteBasicEvent($basicEvent_id) {
        $deleteEventFriends = EventFriend::where('friend_user_id', Auth::user()->id)
                                         ->where('event_id', $basicEvent_id)->delete();
        BasicEvent::where('id', $basicEvent_id)->delete();
        
        return redirect('/home')->with('response', 'Post deleted successfully');
    }
}
