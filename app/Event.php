<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title','description','start_datetime','end_datetime','user_id'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
