<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title', 'description', 'start_at', 'end_at', 'user_id',
    ];

    protected $hidden = [
        'id', 'user_id', 'created_at', 'updated_at'
    ];
}
