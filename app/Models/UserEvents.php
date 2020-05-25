<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserEvents extends Model
{
    protected $table = "user_events";

    protected $fillable = [
        'user_id', 'event_id', 'is_owner'
    ];
}
