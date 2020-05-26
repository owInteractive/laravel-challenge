<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\BasicEvent;
use App\Friend;
use Auth;
use DateTime;
use DateInterval;
use Hash;
use Response;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $basicEvents = BasicEvent::orderBy('start_date', 'asc')->where('user_id', Auth::user()->id)->paginate(5);

        $friendsEvent = DB::table('friends')->join('events_friends', function($j) {
            $j->on('friends.user_id', '=', 'events_friends.friend_user_id')
              ->on('friends.email', '=', 'events_friends.friend_email');
        })->select(['friends.name', 'events_friends.event_id' ])->where('friends.user_id', $user_id)->get();

        return view('home', ['basicEvents' => $basicEvents, 'friends' => $friendsEvent]);
    }

    public function getTodayEvents()
    {
        $user_id = Auth::user()->id;
        $today = date("Y-m-d");
        $basicEvents = BasicEvent::where('start_date', $today)->where('user_id', Auth::user()->id)->paginate(5);

        $friendsEvent = DB::table('friends')->join('events_friends', function($j) {
            $j->on('friends.user_id', '=', 'events_friends.friend_user_id')
              ->on('friends.email', '=', 'events_friends.friend_email');
        })->select(['friends.name', 'events_friends.event_id' ])->where('friends.user_id', $user_id)->get();
        
        return view('home', ['basicEvents' => $basicEvents, 'friends' => $friendsEvent]);
    }

    public function getNext5DaysEvents()
    {
        $user_id = Auth::user()->id;

        $today = date("Y-m-d");
        $date = new DateTime($today);
        $date->add(new DateInterval('P5D'));
        $next5Days = $date->format("Y-m-d");

        $basicEvents = BasicEvent::whereBetween('start_date', [$today, $next5Days])->where('user_id', Auth::user()->id)->paginate(5);
        
        $friendsEvent = DB::table('friends')->join('events_friends', function($j) {
            $j->on('friends.user_id', '=', 'events_friends.friend_user_id')
              ->on('friends.email', '=', 'events_friends.friend_email');
        })->select(['friends.name', 'events_friends.event_id' ])->where('friends.user_id', $user_id)->get();

        return view('home', ['basicEvents' => $basicEvents, 'friends' => $friendsEvent]);
    }
    
    public function changePassword(Request $request) 
    {

        $currentPassword = $request->input('current_password');
        $newPassword = $request->input('new_password');
        $passwordConfirmation = $request->input('password_confirmation');
        $userPassword = Auth::user()->password;
        
        if (!(Hash::check($currentPassword, $userPassword))) {
            return redirect()->back()->with('error', 'Your current password does not matches with the password you provided. Please try again.');
        }
        
        if (strcmp($currentPassword, $newPassword) == 0) {
            return redirect()->back()->with('error', "New Password cannot be same as your current password. Please choose a different password.");
        }

        if (strcmp($newPassword, $passwordConfirmation) != 0) {
            return redirect()->back()->with('error', "New password doesn't match with the confirmation");
        }

        $this->validate($request, [
            'current_password' => 'required',
            'new_password' => 'required',
        ]);

        $user = Auth::user();
        $user->password = bcrypt($newPassword);
        $user->save();

        return redirect()->back()->with("success", "Password changed successfully!");

    }

    public function export() 
    {
        $headers = [
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Content-type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename=calendario.csv',
            'Expires'             => '0',
            'Pragma'              => 'public',
        ];

        $list = BasicEvent::all()->toArray();
        
        array_unshift($list, array_keys($list[0]));

        $callback = function() use ($list) 
        {
            $FH = fopen('php://output', 'w');
            foreach ($list as $row) { 
                fputcsv($FH, $row);
            }
            fclose($FH);
        };

        return Response::stream($callback, 200, $headers);

    }
}
