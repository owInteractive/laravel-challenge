<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invite extends Model
{
    use SoftDeletes;

    protected $fillable = ['event_id', 'name', 'email', 'message'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
