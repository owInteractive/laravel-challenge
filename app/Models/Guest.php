<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Guest extends Model
{
    use Notifiable;

    protected $fillable = [
        'email',
        'token',
    ];

    protected static function boot()
    {
        parent::boot();

        parent::creating(function (Guest $guest) {
            $email = $guest->email;
            $token = hash_hmac('sha256', str_random(40), config('app.key'));
            $guest->token = base64_encode(implode('|', compact('email', 'token')));
        });
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function linkShowEventWithToken()
    {
        return route('event.show', [
            'event' => $this->event,
            'token' => $this->token,
        ]);
    }

    public function validToken($tokenBase64)
    {
        if ($this->token !== $tokenBase64) {
            return false;
        }

        list($email, $token) = explode('|', base64_decode($tokenBase64));

        if (!$email || !$token) {
            return false;
        }

        list($emailGuest, $tokenGuest) = explode('|', base64_decode($this->token));

        return $emailGuest === $email && $tokenGuest === $token;
    }
}
