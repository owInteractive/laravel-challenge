<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'event';
    protected $fillable = [
        'id_owner',
        'title', 'description',
        'start_date', 'end_date'
    ];
}
