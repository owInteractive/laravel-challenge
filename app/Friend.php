<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    public function events() 
    {
        return $this->belongsToMany(Event::class, 'event_friend');
    }
}

