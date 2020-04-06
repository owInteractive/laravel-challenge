<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Migração responsável pela criação da tabela de convites para os eventos
 */
class CreateEventsInvitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events_invites', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_contact');
            $table->string('email');
            $table->integer('id_event');
            // 0 = waiting confirmation, 1 - confirmed, 2 - refused
            $table->integer('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events_invites');
    }
}
