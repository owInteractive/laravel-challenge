<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Event;

class EventCsvController extends Controller
{
    public function create()
    {
        return view('csv.create');
    }

    public function upload(Request $request)
    {

        if ($request->file('imported-file')) {
            $path = $request->file('imported-file')->getRealPath();
            $data = Excel::load($path, function ($reader) {
            })->get();

            if (!empty($data) && $data->count()) {
                
                $data = $data->toArray();
                for ($i = 0; $i < count($data); $i++) {
                    $data[$i]['user_id'] = auth()->user()->id;
                    $data[$i]['created_at'] = date('Y-m-d H:i:s');
                    $dataImported[] = $data[$i];
                }
                
                Event::insert($dataImported);
                return redirect()->route('csv.create')
                        ->with('success','Events importeds successfully');

            }
            
        }
    }

    public function export(Request $request) {
        $items = Event::all();
        Excel::create('items', function($excel) use($items) {
          $excel->sheet('ExportFile', function($sheet) use($items) {
              $sheet->fromArray($items);
          });
      })->export('csv');
    }
}
