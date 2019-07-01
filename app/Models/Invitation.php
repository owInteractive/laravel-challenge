<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    protected $fillable = [
        'event_id',
        'email',
        'token',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class, 'id', 'event_id');
    }
}
