<?php

namespace App\Http\Controllers\Invokables;

use App\Models\Event;
use App\Models\UserEvents;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ExportEvents extends Controller
{
    public function __invoke()
    {
        $csv = $this->csv();

        $handle = fopen("events.csv", "w");
        fwrite($handle, $csv);
        fclose($handle);
        readfile('events.csv');

        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.basename('events.csv'));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('events.csv'));
        readfile('events.csv');
        exit;

    }

    public function csv()
    {
        //Selecting all events related to this user
        $user_events = UserEvents::all()->where('user_id', Auth::id());

        //Creating an array with the Event's ids related to this user
        $ids = array_map( function( $a ) { return $a['event_id']; }, $user_events->toArray());

        //Selecting all events details related to this user
        $events = Event::all()->whereIn('id', $ids)->toArray();

        $csv = "id,title,description,start_date,end_date\n";
        foreach ($events as $item)
        {
            $csv .= $item['id'] . "," .
                $item['title'] . "," .
                $item['description'] . "," .
                $item['start_date'] . "," .
                $item['end_date'] . "\n";
        }
        return $csv;
    }
}
