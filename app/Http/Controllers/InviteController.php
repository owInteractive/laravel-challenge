<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Invite;
use App\Models\User;
use App\Models\Event;
use Illuminate\Support\Str;
use App\Mail\InviteMail;
use Mail;

class InviteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Event $event)
    {
        if ($event->invites()->first()->user_id == auth()->user()->id) 
        {
            $invites = $event->invites()->paginate();
            return view('invite.index', compact('event', 'invites'));
        } else {
            return redirect()->route('event.index')->withStatus(__('Acess denied'));  
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Event $event)
    {
        return view('invite.create', compact('event'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Event $event)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|min:6|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $invite = new Invite();
        $invite->user_id = auth()->user()->id;
        $invite->event_id = $event->id;
        $invite->name = $request->get('name');
        $invite->email = $request->get('email');
        $invite->status = 0;
        $invite->token = Str::random(60);
        $invite->sended_at = now();

        $invite->save();

        $data = [
            'name'      => $request->get('name'),
            'subject'   => 'Invite :: ' . $event->title,
            'from'      => env('MAIL_FROM_ADDRESS', 'lucas@livebrew.com.br'),
            'from_name' =>  env('MAIL_FROM_NAME', 'Lucas AT Livebrew'),
            'token'     => $invite->token,
            'email'     => $request->get('email'),
            'title'     => $event->title,
            'description' => $event->description,
        ];

        Mail::to($request->get('email'), $request->get('name'))->send(new InviteMail($data));
        return redirect()->route('event.index')->withStatus(__('Invite successfully sent.'));
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
        //
    }

    public function confirm(Request $request) {
        $request->session()->flush();
        if (@auth()->user()->id != null) {
            return redirect()->route('logout');
        }


        $success =  Invite::where(['token' => $request->get('token'), 'email' => $request->get('email')])->update(['status' => 1,'accepted_at'=> now()]);
         if (!$success)  {
             return redirect()->route('register')->withStatus(__('error.'));
         }
 
         $user = User::where(['email' => $request->get('email')])->first();
         if (empty($user)) {
             return redirect()->route('register')->withStatus(__('RSVP successfully sent'));
         } else {
             return redirect()->route('login')->withStatus(__('RSVP successfully sent'));
         }
     }
}
