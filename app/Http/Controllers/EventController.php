<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use App\Models\UserEvents;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|Application|\Illuminate\View\View
     */
    public function index()
    {
        //Selecting all events related to this user
        $user_events = UserEvents::all()->where('user_id', Auth::id());

        //Creating an array with the Event's ids related to this user
        $ids = array_map( function( $a ) { return $a['event_id']; }, $user_events->toArray());

        //Selecting all events details related to this user
        $events = Event::all()->whereIn('id', $ids);

        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|Application|\Illuminate\View\View
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);
        $request->merge([
            'user_id' => Auth::id()
        ]);

        $event = Event::create($request->all());

        $event_arr = $event->attributesToArray();
        if(array_key_exists('user_id', $event_arr))
        {
            $this->addUserEvents($event_arr);
            return redirect('events')->with('success', 'event.success');
        }
        return redirect()->back()->with('error', 'event.error');
    }

    public function addUserEvents($data = array())
    {
        return UserEvents::create(
            [
                'user_id' => $data['user_id'],
                'event_id' => $data['id'],
                'is_owner' => true
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param Event $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Event $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Event $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Event $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }
}
