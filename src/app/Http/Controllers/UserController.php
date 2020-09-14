<?php

namespace App\Http\Controllers;

use App\Event;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Invite;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Notification;
use App\Notifications\InviteNotification;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('registration_view');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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
        $user = User::find($id);
        return view('users.edit',compact('user'));
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
        $user = User::find($id);
        $request->validate([
            'name' => 'required',
            'password' => 'required',
            'email' => 'required',
        ]);
        $user->name = $request->get('name');
        $user->password = Hash::make($request->get('password'));
        $user->email = $request->get('email');

        $user->save();
        Auth::logout();
        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials))
            return redirect()->route('home')->with('success','User updated successfully');
        else
            return redirect()->route('login')->with('error','User can not be updated');
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
    public function invite_view()
    {
        $events = Event::where('user_id', Auth::id())->get();
        return view('users.invite', compact('events'));
    }
    public function process_invites(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email'
        ]);
        $validator->after(function ($validator) use ($request) {
            $invited = $request->get('email');
            if (Invite::where('email', $invited)->exists()) {
                $validator->errors()->add('email', 'There exists an invite with this email!');
            }
        });
        if ($validator->fails()) {
            return redirect(route('invite_view'))
                ->withErrors($validator)
                ->withInput();
        }

        do {
            $token = Str::random(20);
        } while (Invite::where('token', $token)->first());

        $invited = $request->get('email');
        $eventId = $request->get('eventId');
        $invite = new Invite;
        $invite->token = $token;
        $invite->email = $invited;
        $invite->save();

        $url = URL::temporarySignedRoute(
            'registration', now()->addMinutes(300), ['token' => $token]
        );
        Notification::route('mail', $invited)->notify(new InviteNotification($url, $eventId));
        return redirect('/users')->with('success', 'The Invite has been sent successfully');
    }
    public function registration_view($token)
    {
        $invite = Invite::where('token', $token)->first();
        return view('auth.register',['invite' => $invite]);
    }

}
