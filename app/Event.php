<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
  const FILTER_EVENTS_ALL         = 1;
  const FILTER_EVENTS_TODAY       = 2;
  const FILTER_EVENTS_NEXT_5_DAYS = 3;

  protected $fillable = [
 'title', 'description', 'ts_start', 'ts_end',
];

}
