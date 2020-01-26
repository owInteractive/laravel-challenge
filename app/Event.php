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
      'start_datetime',
      'end_datetime'
    ];
    protected $hidden = [
      'id',
      'user_id',
      'title',
      'description',
      'start_datetime',
      'end_datetime',
      'created_at',
      'updated_at',
      'deleted_at'
    ];
}
