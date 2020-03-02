<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guests extends Model
{
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'guest_id';

    protected $fillable = [
        'guest_name', 'guest_email', 'guest_mobile',
    ];

    use SoftDeletes;
}
