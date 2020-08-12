<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;
use App\EventMail;

class Event extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'start_date','start_time', 'end_date', 'end_time', 'user_id',
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

    /**
     * Get the mails for the event.
     */
    public function emails()
    {
        return $this->hasMany(EventMail::class);
    }
}
