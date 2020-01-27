<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Event;
use Carbon\Carbon;
use Excel;


class CsvController extends Controller
{
  public function import()
  {
    return view('event.import');
  }

  public function exportAll()
  {
    $event = Event::where('user_id', Auth::user()->id)->get()->toArray();
    return Excel::create('calendar_events', function ($excel) use ($event) {
       $excel->sheet('mySheet', function ($sheet) use ($event) {
          $sheet->fromArray($event);
       });
    })->download('csv');
  }

  public function exportSingle($id)
  {
    $event = Event::findOrFail($id)->toArray();
    return Excel::create('calendar_events', function ($excel) use ($event) {
      $excel->sheet('mySheet', function ($sheet) use ($event) {
        $sheet->fromArray($event);
      });
    })->download('csv');
  }

  public function importCsv(Request $request)
  {
    ($path = $request->file('import_file')->getRealPath());
    $events = Excel::load($path)->get();
    if ($events->count()) {
      foreach ($events as $key => $value) {
        $arr[] = [
          'user_id' => Auth::user()->id,
          'title' => $value->title,
          'description' => $value->description,
          'start_datetime' => $value->start_datetime,
          'end_datetime' => $value->end_datetime,
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
        ];
      }
      if (!empty($arr)) {
        Event::insert($arr);
      }
    }
    return redirect('/event')->with('success', 'Events imported with success');
  }
}