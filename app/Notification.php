<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
       'user_id','from','event_id','event_name'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
