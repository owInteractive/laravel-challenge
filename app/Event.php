<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'title', 'description', 'start_datetime', 'end_datetime'];
    protected $casts = ['start_datetime' => 'datetime', 'end_datetime' => 'datetime'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function invites()
    {
        return $this->hasMany(Invite::class);
    }
}
