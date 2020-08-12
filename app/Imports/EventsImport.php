<?php

namespace App\Imports;

use App\Event;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Auth;

class EventsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Event([
            'title'         => $row[0],
            'description'   => $row[1],
            'start_date'    => $row[2],
            'start_time'    => $row[3],
            'end_date'      => $row[4],
            'end_time'      => $row[5],
            'user_id'       => Auth::user()->id
        ]);
    }
}
