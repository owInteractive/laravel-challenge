<?php

namespace App\Exports;

use App\Event;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings; 

class EventsExport implements FromCollection,WithHeadings
{
    public function headings():array
    {
        return [
            "id",
            "title",
            "description",
            "start_datetime",
            "end_datetime"
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect(Event::all());
    }
}
