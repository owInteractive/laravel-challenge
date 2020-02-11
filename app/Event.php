<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'user_id','title', 'description', 'start_date', 'end_datetime'
    ];

    protected $dates = [
        'start_date',
        'end_datetime'
    ];

    protected $dateFormat = 'Y-m-d';

    public $timestamps = false;
}
