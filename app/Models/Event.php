<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public $fillable = ['title', 'description', 'start', 'end', 'users_id'];

}
