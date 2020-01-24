<?php

namespace App\Imports;

use App\Event;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Eventsmport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Event([
            'title'     => $row['title'],
            'description'    => $row['description'], 
            'start' => $row['start'],
            'end' => $row['end'],
        ]);
    }
}
