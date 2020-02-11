<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;
use App\Exports\EventsExport;
use App\Imports\EventsImport;
use Maatwebsite\Excel\Facades\Excel;




class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        $events = Event::where('user_id', $user->id)->paginate(10);
        //dd($events[0]->invites()->get()[0]->status);
        return view('events.index', compact('events'))->withDetails($events);
    }

    private function getByDates($user, $from = null, $to)
    {
        $from == null ? Carbon::today() : $from;
        $events = Event::where('user_id', $user->id)->whereBetween('start_at', [$from, $to])->orWhereBetween('end_at', [$from, $to]);
        return $events;
    }

    private function _today()
    {
        $user = auth()->user();
        $today = Carbon::today();
        $date = $today->add(0, 'day')->format('Y-m-d 23:59:59');
        return $this->getByDates($user, Carbon::today(), $date);
    }

    public function today()
    {
        $events = $this->_today()->paginate(10);
        return view('events.index', compact('events'))->withDetails($events);
    }

    private function _five()
    {
        $user = auth()->user();
        $today = Carbon::today();
        $date = $today->add(5, 'day')->format('Y-m-d 23:59:59');
        return $this->getByDates($user, Carbon::today(), $date);
    }

    public function five()
    {
        $events = $this->_five()->paginate(10);
        return view('events.index', compact('events'))->withDetails($events);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3|max:255',
            'description' => 'required|min:6|max:255',
            'start_at' => 'required',
            'end_at' => 'required|after:start_at',

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        $event = new Event();
        $event->user_id = auth()->user()->id;
        $event->title = $request->get('title');
        $event->description = $request->get('description');
        $event->start_at = Carbon::createFromFormat('d/m/Y H:i:s', $request->get('start_at'))->toDateTimeString();
        $event->end_at = Carbon::createFromFormat('d/m/Y H:i:s', $request->get('end_at'))->toDateTimeString();
        $event->save();
        return redirect()->intended(route('event.index'))->withStatus('Event successfully created.');
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
     * @param  Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        if (auth()->user()->id != $event->user_id) {
            return redirect()->intended(route('event.index'))->withStatus('Permission denied.');
        }

        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3|max:255',
            'description' => 'required|min:6|max:255',
            'start_at' => 'required|date_format:d/m/Y H:i:s',
            'end_at' => 'required|date_format:d/m/Y H:i:s|after:start_at',

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        if (auth()->user()->id != $event->user_id) {
            return redirect()->intended(route('event.index'))->withStatus('Permission denied.');
        }

        $event->user_id = auth()->user()->id;
        $event->title = $request->get('title');
        $event->description = $request->get('description');

        $event->start_at = Carbon::createFromFormat('d/m/Y H:i:s', $request->get('start_at'))->toDateTimeString();
        $event->end_at = Carbon::createFromFormat('d/m/Y H:i:s', $request->get('end_at'))->toDateTimeString();
        $event->update();

        return redirect()->route('event.index', $event)->withStatus(__('Event successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Event $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('event.index')->withStatus(__('Event successfully deleted.'));
    }

    /**
     * 
     */
    public function export()
    {
        $url = explode('/', $_SERVER['HTTP_REFERER']);
        $eventExport = new EventsExport();

        switch (end($url)) {

            case 'event':
            default:
                $events = Event::select('title', 'description', 'start_at', 'end_at')->where('user_id', auth()->user()->id)->get();
                $eventExport->set($events);
                $file = "my_events.csv";
                break;

            case 'today':
                $file = "today.csv";
                $eventExport->set($this->_today()->get());
                break;

            case 'five':
                $file = "five_days.csv";
                $eventExport->set($this->_five()->get());
                break;
        }

        return Excel::download($eventExport, $file, \Maatwebsite\Excel\Excel::CSV);
    }

    /**
     * 
     */
    public function import(Request $request)
    {
        if (!empty($request->file)) {
            $validator = Validator::make($request->all(), [
                'file' => 'required|mimes:csv,txt,xls,xlsx|max:2048',
            ]);

            if ($validator->fails()) return redirect()->back()->withStatus('File not supported.');

            $fileName = auth()->user()->id . '_' . time() . '.' . $request->file->extension();

            if (!$request->file->move(public_path('uploads'), $fileName)) {
                return redirect()->route('event.index')->withStatus(__('File not uploaded.'));
            }

            Excel::import(new EventsImport,  public_path('uploads') . '/' .  $fileName);
            return redirect()->route('event.index')->withStatus(__('Event successfully imported.'));
        }
        return redirect()->route('event.index')->withStatus(__('File not found.'));
    }


}
