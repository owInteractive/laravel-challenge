<?php

namespace App\Constants;

class EventsConstants
{
    const CSV_HEADERS = [
        'title',
        'description',
        'start_date',
        'end_date',
        'participants',
    ];

    const CSV_REQUIRED_VALUES = [
        'title',
        'start_date',
        'end_date'
    ];
}

