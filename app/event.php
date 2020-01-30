<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class event extends Model
{
    protected $fillable = ['title', 'description', 'date_begin', 'time_begin', 'date_end', 'time_end'];
}
