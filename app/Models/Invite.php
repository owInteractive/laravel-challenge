<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    protected $fillable = [
        'email', 
        'presence',
        'valid_until',
        'event_id',
        'token'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
