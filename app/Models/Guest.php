<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $fillable = [
        'email'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
