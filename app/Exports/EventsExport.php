<?php

namespace App\Exports;

use App\Event;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class EventsExport implements FromCollection, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Event::where('user_id', \Auth::user()->id)->get();
    }
}
