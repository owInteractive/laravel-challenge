<?php

namespace App\Imports;

use App\Events;
use Maatwebsite\Excel\Concerns\ToModel;

class Eventimport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
     return new Events([
              'id'     => $row[0],
              'title'     => $row[1],
              'description'    => $row[2],
              'start'   => $row[3],
              'end'  => $row[4],
              'created_at'  => $row[5],
              'updated_at'  => $row[6],
              'user_id'  => $row[7],
           ]);
    }
}
