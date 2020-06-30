<?php

namespace App\Imports;

use App\eventos;
use Maatwebsite\Excel\Concerns\ToModel;


class EventoImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new eventos([
            'title'=>$row[0],
            'description'=>$row[1],
            'dataI'=>$row[2],
            'dataF'=>$row[3],
        ]);
    }
}
