<?php

namespace App\Exports;
use Carbon\Carbon;

use App\Event;
use Maatwebsite\Excel\Concerns\FromCollection;

class EventsNextFiveDaysExport implements FromCollection
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
        return collect(Event::where('start_datetime' , '>=' , Carbon::now()->addDays(5)->toDateString())->get());
    }
}
