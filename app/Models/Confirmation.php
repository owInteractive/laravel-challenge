<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Confirmation extends Model
{
    protected $fillable = [
        'name','event_id'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }



}
