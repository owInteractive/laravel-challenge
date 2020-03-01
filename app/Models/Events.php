<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Events extends Model
{
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'event_id';

    protected $fillable = [
        'user_id', 'guest_id', 'event_title', 'event_description', 'event_start', 'event_end',
    ];

    use SoftDeletes;
}
