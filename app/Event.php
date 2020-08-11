<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

class Event extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'start_at', 'end_at', 'user_id',
    ];

    /**
     * Relationships
     */

    /**
     * Get the user that owns the event.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
