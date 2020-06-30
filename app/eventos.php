<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class eventos extends Model
{
protected $guarded = [];

public function getRouteKeyName()
{
    return 'title';
}

}


