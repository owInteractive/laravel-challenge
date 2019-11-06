<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'event_id', 'email', 'token',
    ];

    /**
     * Get the event
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function event() {
        
        return $this->belongsTo(Event::class);
    }
}
