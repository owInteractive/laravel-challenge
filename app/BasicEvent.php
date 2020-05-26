<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BasicEvent extends Model
{
    public function friends() 
    {
        return $this->belongsToMany(Friend::class, 'event_friend');
    }
}
