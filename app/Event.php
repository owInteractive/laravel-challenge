<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $guarded = ['_token'];
    protected $fillable = ['title', 'description', 'start', 'end', 'user_id'];
}
