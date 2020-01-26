<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class ConfirmEventController extends Controller
{
    public function index($id){
        $event = Event::find($id);      
        

        return view("events.confirmevent",['event'=>$event]);
    }
}
