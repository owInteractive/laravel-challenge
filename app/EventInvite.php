<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventInvite extends Model
{
    protected $guarded = ['_token'];
    protected $fillable = ['name', 'email', 'cellphone','event_id'];
}
