<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
   //PODE SER PREENCHIDO PELO USUARIO
   protected $fillable = [
    'title',///titulo do evento
    'description',//descrição do evento
    'start',//inicio do evento 
    'end',//fim do evento
    'owner',///codigo do criador do evento
];
}


