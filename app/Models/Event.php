<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

    protected $fillable = [
       'user_id','title','description','start_at','end_at',
    ];

    public function invites()
    {
        return $this->hasMany(Invite::class,'event_id','id');
    }
}


