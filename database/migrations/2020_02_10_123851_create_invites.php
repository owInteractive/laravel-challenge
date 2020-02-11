<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvites extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invites', function (Blueprint $table) {
            $table->integer('event_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('name');
            $table->string('email');
            $table->string('token');
            $table->boolean('status');
            $table->datetime('sended_at');
            $table->datetime('accepted_at')->nullable();
            /*
            $table->foreign('event_id', 'fk_event_id')
                ->references('id')
                ->on('events')
                ->onDelete('cascade');

            $table->foreign('user_id', 'fk_user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            */
            $table->primary('token');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_events');
    }
}
