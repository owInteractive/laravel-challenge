<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function __construct()
    {
    }
    public function index($id = null)
    {
        $events = Event::all();
        return view('event', compact('events'));
    }

    public function formEvent($id = null)
    {
        if ($id) {
            $event = Event::find($id);

            return view('formCadastrar', compact('event'));
        }
        return view('formCadastrar');
    }

    public function create(request $request)
    {

        if ($request) {
            $data = $request->all();

            Event::create($data);
        }
        return redirect()->route('event');
    }
    public function update($id, request $request)
    {
        $data = $request->all();
        Event::find($id)->update($data);
        return redirect()->route('event');
    }
    public function delete($id)
    {
        Event::destroy($id);
        return redirect()->route('event');
    }
}
