<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePresence extends Migration
{
  
    public function up()
    {   Schema::create('presences', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('id_user')->unsigned(); //CODIGO DO CRIADOR DO EVENTO                
        $table->foreign('id_user')
        ->references('id')
        ->on('users')
        ->onDelete('cascade');
        $table->integer('id_event')->unsigned(); //CODIGO DO EVENTO                
        $table->foreign('id_event')
        ->references('id')
        ->on('events')
        ->onDelete('cascade');
        $table->enum('invite_status', ['Aguardando Resposta', 'Confirmado','Rejeitado']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('presences');

    }
}
