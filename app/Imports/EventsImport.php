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
            
            'titulo' => $row[0],
            'descricao'      => $row[1],
            'dataInicio'     => $row[2],
            'dataFim'        => $row[3],
            'user_id'        => $row[4],
            'created_at'     => $row[5],
            'updated_at'     => $row[6],
        ]);
    }
}
