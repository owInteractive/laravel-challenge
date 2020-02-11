<?php

namespace App\Exports;

use App\Event;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EventsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $events = Event::all();      
        
        return $events;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'id',           
            'user_id',
            'title',
            'description',
            'start_date',
            'end_datetime'
        ];
    } 
}
