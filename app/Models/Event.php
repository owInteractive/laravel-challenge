<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'start_at', 'end_at',
    ];

    /**
     * Get the event's owner
     */
    public function owner() {
        return $this->belongsTo(User::class);
    }
}
