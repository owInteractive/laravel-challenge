<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use Excel;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ExcelController extends Controller
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

  public function importExcel(Request $request)
  {
    $path = $request->file('import_file')->getRealPath();
    $events = Excel::load($path)->get();
    if ($events->count()) {
      foreach ($events as $key => $value) {
        $arr[] = [
          'user_id' => Auth::user()->id,
          'title' => $value->title,
          'description' => $value->description,
          'date_time_start' => $value->date_time_start,
          'date_time_end' => $value->date_time_end,
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
