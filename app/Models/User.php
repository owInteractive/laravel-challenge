<?php

namespace App\Models;

use App\Notifications\EventInviteNotification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the user's events
     */
    public function events() {
        return $this->hasMany(Event::class);
    }

    /**
     * Get the event's attendees
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function registrationEvents()
    {
        return $this->belongsToMany(Event::class,'registrations')->using(Registration::class)->withTimestamps();;
    }

    /**
     * Notify the user about invites
     */
    public function receiveInvite($event, $invite) {
        $this->notify(new EventInviteNotification($event, $invite));
    }

}
