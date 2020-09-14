<?php

namespace App\Imports;

use App\Event;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EventsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $id = Event::all()->last()->id;
        $event = new Event([
            'id' => $id+1,
            'title' => $row[1],
            'description' => $row[2],
            'start' => $row[3],
            'end' => $row[4],
            'user_id' => Auth::id(),
        ]);
        $event->save();

        return $event;
    }
}
