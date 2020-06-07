<?php

namespace App\Exports;

use App\Events;
use Maatwebsite\Excel\Concerns\FromCollection;

class Eventexport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Events::all();
    }
}
