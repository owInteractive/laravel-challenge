<?php

namespace App\Exports;

use App\Repository\EventRepository;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Event;

class EventsExport implements FromCollection
{
    public function __construct($period)
    {
        $this->period = $period;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if ($this->period == 'today') {
            $events = (new EventRepository)->today();
        } else if ($this->period == 'next-days') {
            $events = (new EventRepository)->nextDays();
        } else {
            $events = Event::orderBy('id', 'desc')->orderBy('id', 'desc')->get();
        }

        return $events;
    }
}
