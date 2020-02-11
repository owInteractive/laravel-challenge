<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Invite extends Model
{
    protected $fillable = [
        'event_id', 'email', 'status'
    ];
    
    protected $table = 'invites';

    static function decryptId($id) {
        try {
            return Crypt::decryptString($id);
        } catch (\Exception $e) {
            return false;
        }
    }
}
