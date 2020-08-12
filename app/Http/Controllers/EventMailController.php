<?php

namespace App\Http\Controllers;

use App\EventMail;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; 

class EventMailController extends Controller
{
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
        $request->validate([
            'event_id' => 'bail|required|exists:events,id',
            'email' => ['required',
                         'email',
                        Rule::unique('event_mails')->where(function($query) use($request){
                            $query->where('event_id', '=', $request->event_id);
                        })   
                ],
        ]);

        $eventMail = new EventMail;

        $eventMail->email = $request->email;
        $eventMail->event_id = $request->event_id;
        $eventMail->save();

        return redirect('/events/invite/' . $request->event_id)->with('success', 'Friend invited!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EventMail  $eventMail
     * @return \Illuminate\Http\Response
     */
    public function show(EventMail $eventMail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EventMail  $eventMail
     * @return \Illuminate\Http\Response
     */
    public function edit(EventMail $eventMail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EventMail  $eventMail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EventMail $eventMail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EventMail  $eventMail
     * @return \Illuminate\Http\Response
     */
    public function destroy(EventMail $eventMail)
    {
        //
    }
}
