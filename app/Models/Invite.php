<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Invite extends Model
{
    protected $fillable = [
        'email', 'expiration'
    ];

    protected $dates = [
        'expiration'
    ];

    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model){
           $model->code = str_random(45);
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
