<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInvitationsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invitations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('eventid')->unsigned();
            $table->string('email', 190);
            $table->string('code', 30)->unique()->nullable();
            $table->dateTime('expiration')->nullable();
            $table->boolean('confirm')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('eventid')->references('id')->on('events');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('invitations');
    }
}
