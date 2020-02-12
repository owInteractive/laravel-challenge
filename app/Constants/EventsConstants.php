<?php

namespace App\Constants;

class EventsConstants
{
    const CSV_HEADERS = [
        'owner',
        'title',
        'description',
        'start_date',
        'end_date',
        'participants',
    ];

    const CSV_REQUIRED_VALUES = [
        'owner',
        'title',
        'start_date',
        'end_date'
    ];
}

