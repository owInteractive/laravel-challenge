<?php

namespace App\Http\Controllers\Invokables;

use App\Models\Event;
use App\Models\UserEvents;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ImportEvents extends Controller
{
    public function __invoke(Request $request)
    {
        //Validating
        $this->validate($request, [
            'file' => 'required'
        ]);

        //Retrieving file object
        $file = $request->file;

        /*
         * When the file is generated, at the end of every "row"
         * there is a "EOL" aka "\n"
         * So it's possible to create an array when exploding the string
         * using "\n" as key to delimit it
         * */
        $content = explode(PHP_EOL, file_get_contents($file));

        //It will generated an array with N + 1 rows
        array_pop($content);

        //Mapping the array
        $csv = array_map('str_getcsv', $content);

//        echo "<pre>";
//        print_r($csv);
//        echo "</pre>";
//        die();

        array_walk($csv, function(&$a) use ($csv) {
            $a = array_combine($csv[0], $a);
        });

        array_shift($csv);

        $this->insertEvents($csv);

        return redirect('/exporter')->with('success', 'Events were imported, repeated ones were ignored!');
    }

    public function insertEvents($arr = array())
    {
        foreach ($arr as $key => $value)
        {
//            echo "<pre>";
//            print_r($value);
//            echo "</pre>";
            if(DB::table('user_events')->where([
                                            ['event_id', '=', $value['id']],
                                            ['user_id', '=', Auth::id()]
                                        ])->get()->toArray() == array())
            {
                $event = Event::create([
                    'user_id' => Auth::id(),
                    'title' => $value['title'],
                    'description' => $value['description'],
                    'start_date' => $value['start_date'],
                    'end_date' => $value['end_date'],
                ])->toArray();

                UserEvents::create([
                    'event_id' => $value['id'],
                    'user_id' => Auth::id(),
                    'is_owner' => 0
                ]);

            }
        }
    }
}
