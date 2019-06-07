<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
      'title',
      'description',
      'date_time_start',
      'date_time_end'
    ];
}
