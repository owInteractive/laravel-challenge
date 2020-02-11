<?php

namespace App\Exports;

use App\Models\Event;
use Maatwebsite\Excel\Concerns\FromCollection;

class EventsExport implements FromCollection
{

    private $events;

    public function set($events = null)
    {
        $this->events = $events == null ? Event::select('title', 'description', 'start_at', 'end_at')->where('user_id', auth()->user()->id)->get() : $events;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->events;
    }
}
