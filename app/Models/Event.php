<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Event extends Model
{
    protected $fillable = [
        'title', 'description','start','end','user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
