<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    protected $table = "invites";

    protected $fillable = [
        'user_id', 'event_id', 'hash'
    ];
}
