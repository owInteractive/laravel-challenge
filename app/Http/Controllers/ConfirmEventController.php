<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Confirmation;
use App\Models\Event;

class ConfirmEventController extends Controller
{
    public function index($id){
        $event = Event::find($id);      
        

        return view("events.confirmevent",['event'=>$event]);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'event_id' => 'required',
        ]);
  
        Confirmation::create($request->all());
   
        return redirect()->route('confirmevent.successconfirm');
    }

    public function successConfirmation(){
        return view('confirmations.confirmationSuccess');
    }
}
