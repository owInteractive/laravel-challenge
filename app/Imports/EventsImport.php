<?php

namespace App\Imports;

use App\Models\Event;
use Maatwebsite\Excel\Concerns\ToModel;

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
            'user_id' => auth()->user()->id,
            'title'     => $row[0],
            'description'    => $row[1], 
            'start_at'    => $row[2], 
            'end_at'    => $row[3], 
        ]);
    }
}
