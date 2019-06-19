<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
   //PODE SER PREENCHIDO PELO USUARIO
   protected $fillable = [
    'id_user',///ID DO USUARIO 
    'id_event',//ID DO EVENTO
    'invite_status',//STATUS DA PRESENÇA 
    ]; 
    
}
