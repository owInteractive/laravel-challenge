<?php

namespace App;
use App\Event;

use Illuminate\Database\Eloquent\Model;

class EventMail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mail', 'event_id',
    ];


    /**
     * Get the event that owns the mail.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
