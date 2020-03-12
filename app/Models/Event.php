<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $dates = [
        'event_start',
        'event_end',
    ];

    protected $fillable = [
        'title',
        'description',
        'event_start',
        'event_end',
        'user_id'
    ];

   
}
