<?php
namespace App\Http\Controllers;

use App\EventInvite;
use App\Event;

use Illuminate\Http\Request;

class EventInviteController extends Controller
{

    public function create($id) {
        $event = Event::where('id', $id)->first();
        return view('invite.create', compact('event'));
    }

    public function store(Request $request)
    {
 
        $this->validate($request, [
            'email' => 'required',
            'name' => 'required',
            'cellphone' => 'required',
        ]);

        EventInvite::create($request->all());
        return redirect()->route('invite', $request->event_id)
                        ->with('success','Cool you will particiate!');
    }
}
