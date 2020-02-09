<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Event extends Model
{
    protected $fillable = [
        'title', 'user_id', 'description', 'start_date', 'finish_date'
    ];

    protected $table = "events";

    static function decryptId($id) {
        try {
            return Crypt::decryptString($id);
        } catch (\Exception $e) {
            return false;
        }
    }
}
