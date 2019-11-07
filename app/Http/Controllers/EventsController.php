<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use App\Models\User;
use Excel;


class EventsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        $events = Event::creator($user)
            ->isAttendee($user)
            ->orderBy('start_at','asc')->paginate(5);
       
        $events_today = Event::creator($user)
            ->isAttendee($user)
            ->today()->get();
            
        $events_next = Event::creator($user)
            ->isAttendee($user)
            ->orderBy('start_at', 'asc')->nextDays(5)->get();

        return view('events.index', [ 
            'events' => $events,
            'events_today' => $events_today,
            'events_next' => $events_next
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEventRequest $request)
    {
       
        $event = Event::create($request->all());
        
        session()->flash('success','Event has been created.');
        
        return redirect()->route('events.edit', $event->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return view('events.show', ['event' => $event]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        $this->authorize('update', $event);

        return view('events.edit', ['event' => $event]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEventRequest $request, Event $event)
    {   
        $this->authorize('update', $event);
        // dd($request->all());
        $event->update($request->all());        
        
        session()->flash('success','Event has been updated.');
        
        return redirect()->route('events.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $this->authorize('delete', $event);
        
        $event->delete();
        
        session()->flash('success','Event has been deleted.');

        return redirect()->route('events.index');
    }

    /** 
     * Inviting the user
     * 
     * @param \App\Models\Event $event
     * @param \Illuminate\Http\Request $request
     */
    public function invite(Request $request, Event $event)
    {
        $this->authorize('invite', $event);

        $email = request('email');
        $user = User::where('email', $email)
            ->where('email','!=', auth()->user()->email)
            ->first();
        
        // check if user is attending the event
        if(!empty($user)) {
            $is_attendee = $event->attendees()->where('user_id', $user->id)->first(); 
            if(!empty($is_attendee)){
                session()->flash('info', 'The user is already attending the event');
                return redirect()->route('events.show', $event->id);
            }
        }
        
        //check if exist an invite
        $invite = $event->invites()->where(
            ['email' => $email],
            ['event_id' => $event->id]
        )->first();
        
        //if exists invite redirect
        if(!empty($invite)){
            session()->flash('info', 'The user has already been invited to this event.');
            return redirect()->route('events.show', $event->id);
        }
        
        $invite = $event->invites()->create([
            'user_id' => auth()->user()->id,
            'event_id' => $event->id,
            'token' => str_random(60),
            'email' => $email
        ]);

        if($user) {
            $user->receiveInvite($event, $invite);
            $message = 'The invitation was sent by email.';
        } else {
            //send mail
            $message = 'The invitation was sent by email.';
        }  

        session()->flash('success', $message);
        return redirect()->route('events.show', $event->id);
    }

    /**
     * Accept the invite
     */
    public function accept_invite(Request $request, Event $event, $token)
    {
        
        $invite = $event->invites()->where('token',$token)->first();
        
        if(!$invite) {
            session()->flash('danger','This link is not valid.');
            return redirect()->route('events.index');
        }

        $attendee = User::where('email', $invite->email)->first();

        if($attendee) {
            $event->attendees()->attach($attendee);
            $event->invites()->where('token',$token)->delete();

            session()->flash('success','You are now attending the event.');
            return redirect()->route('events.index');
        }
    }

    /**
     * Accept the invite
     */
    public function reject_invite(Request $request, Event $event, $token)
    {
        
        $invite = $event->invites()
                ->where('token',$token)
                ->where('email', auth()->user()->email)->first();

        if(!$invite) {
            session()->flash('danger','This link is not valid.');
            return redirect()->route('home');
        }

        $event->invites()->where('token',$token)->delete();

        session()->flash('success','You recjected the invite.');
        return redirect()->route('home');       
    }

    /**
     * Export a flie in storage 
     * 
     * @param \Illluminate\Http\Request $request
     * @return \Illumintate\Http\Response
     */
    public function export()
    {
        $user = auth()->user();

        $events = Event::creator($user)
            ->isAttendee($user)
            ->orderBy('start_at','asc')->get();

        Excel::create('events', function($excel) use($events){
            $excel->sheet('ExportFile', function($sheet) use($events){
                $sheet->fromArray($events);
            });
        })->export('csv');
    }

    /**
     * Import a flie in storage 
     * 
     * @param \Illluminate\Http\Request $request
     * @return \Illumintate\Http\Response
     */
    public function import(Request $request)
    {
        $user = auth()->user();

        if($request->hasFile('events-import')) {
            $path = $request->file('events-import')->getRealPath();

            $data = Excel::load($path, function($reader){})->get();
            
            if(!empty($data && $data->count())) {
                $data = $data->toArray();

                for($i = 0; $i < count($data); $i++) {
                    $imported[] = $data[$i];
                }

                Event::insert($imported);
            }
            session()->flash('success','Events imported');
            return redirect()->route('events.index');
        }

        session()->flash('danger','Could not import events');
        return redirect()->route('events.index');
    }    
}
