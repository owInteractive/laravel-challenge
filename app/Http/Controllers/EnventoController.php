<?php

namespace App\Http\Controllers;

class EnventoController extends Controller
{
    public function store()
    {
        request()->validate([
            'name'=>'required',
            'email'=>'required|email',
            'subject'=>'required',
            'content'=>'required|min:5'
            
        ]);

        
        return back()->with('status','Tu invitacion fue enviada con exito');
    }
}
