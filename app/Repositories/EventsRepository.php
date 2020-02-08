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

}