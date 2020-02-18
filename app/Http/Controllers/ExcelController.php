<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Excel;

class ExcelController extends Controller
{
    protected $eventModel;

    public function __construct(Event $eventModel)
    {
        $this->eventModel = $eventModel;
    }

    public function index()
    {
        return view('events.import');
    }

    public function export($id = null)
    {

        if ($id) {
            $events = $this->eventModel->find($id)->toArray();
        } else {
            $events = $this->eventModel->where('user_id', \Auth::user()->id)->get()->toArray();
        }

        return Excel::create('calendar_events', function ($excel) use ($events) {
            $excel->sheet('mySheet', function ($sheet) use ($events) {
                $sheet->fromArray($events);
            });
        })->download('csv');
    }

    public function import(Request $request)
    {
        $path = $request->file('events_file')->getRealPath();
        $events = Excel::load($path)->get();
        if ($events->count()) {
            foreach ($events as $key => $value) {
                $arr[] = [
                    'user_id' => \Auth::user()->id,
                    'title' => $value->title,
                    'description' => $value->description,
                    'start_at' => $value->start_at,
                    'end_at' => $value->end_at,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ];
            }
            if (!empty($arr)) {
                $this->eventModel->insert($arr);
            }
        }
        return redirect()->route('events.index')->with('success', 'Events imported!');
    }
}
