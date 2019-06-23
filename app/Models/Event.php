<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'description',
        'start',
        'end',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Event $event) {
            if ($user = auth()->user()) {
                $event->user()->save($user);
            }
        });
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
