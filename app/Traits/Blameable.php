<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait Blameable
{

    public static function boot() {
        parent::boot();    
        if(Auth::check()){
            static::creating(function($model) {
                $model->user_id = Auth::id();
            });

        }
    }
    
}
