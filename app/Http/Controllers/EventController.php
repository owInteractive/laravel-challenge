<?php

namespace App\Http\Controllers;
use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;

class EventController extends Controller
{

    public function index()
    {   
        $where_clauses = [];
        $events = null;
        
        if (Input::has('today_events')) {
			$events = Event::whereRaw('Date(start) = CURDATE()')->orderBy('id', 'DESC')->paginate(10);
        } else if (Input::has('next_events')) {
            $events = Event::whereRaw('start > NOW()')->orderBy('id', 'DESC')->get()->take(5);
        } else {
            $events = Event::orderBy('id','desc')->paginate(10);
        }

        return view('events.index',compact('events'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }
   
    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'start' => 'required',
            'end' => 'required',
        ]);
        
        $request->merge(["user_id" => auth()->user()->id]);
        Event::create($request->all());
   
        return redirect()->route('events')
                        ->with('success','Event created successfully.');
    }

    public function edit($id)
    {   
        $event = Event::where('id',$id)->first();
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'start' => 'required',
            'end' => 'required',
        ]);

        Event::where('id', $request->id)->update($request->except('_token'));
        return redirect()->route('events')
                        ->with('success','Event updated successfully');
    }

    public function destroy($id)
    {
        Event::destroy($id);
        return redirect()->route('events')
                        ->with('success','Event deleted successfully');
    }

}
