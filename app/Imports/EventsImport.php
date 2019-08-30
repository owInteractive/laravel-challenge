<?php

namespace App\Imports;

use App\Models\Event;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Auth;

class EventsImport implements ToModel , WithHeadingRow
{

    use Importable;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user=Auth::user();
        //\Log::debug ($row);
        return new Event([
            'title'         => $row['title'],
            'description'   => $row['description'], 
            'start'         => $row['start'],
            'end'           => $row['end'],
            'owner'         => $user['id'],
        ]);
    }

}
