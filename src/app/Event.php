<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'id', 'name', 'title', 'description', 'start', 'end', 'user_id'
    ];
}
