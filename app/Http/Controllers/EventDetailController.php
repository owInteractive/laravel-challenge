<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;

class EventDetailController extends Controller
{
    public function event($event){

        $event = Event::find($event);
        
        return view('event', compact('event'));

    }
}
