<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class HomeController extends Controller
{
    public function index(){
        $user = auth()->user();

        $events = Event::creator($user)->latest()->count();
        $events_today = Event::creator($user)->today()->get()->count();
        $events_next = Event::creator($user)->nextDays(5)->get()->count();

        return view('home',[ 
            'events' => $events,
            'events_today' => $events_today,
            'events_next' => $events_next
        ]);
    }
}
