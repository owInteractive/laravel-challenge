<?php

namespace App\Repositories;

use App\Models\Events;

class EventsRepository
{
    private $events;

    public function __construct(Events $events)
    {
        $this->events = $events;
    }

    public function get()
    {
        return $this->events->get();
    }
}
