<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
  use SoftDeletes;
  protected $fillable = [
    'user_id',
    'title',
    'description',
    'date_time_start',
    'date_time_end'
  ];
  protected $hidden = [
    'id',
    'user_id',
    'created_at',
    'updated_at',
    'deleted_at',
  ];
}
