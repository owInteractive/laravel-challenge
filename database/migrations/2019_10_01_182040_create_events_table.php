<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('description', 5100);
            $table->dateTime('start');
            $table->dateTime('end');
            $table->integer('users_id')->unsigned();

            $table->rememberToken();
            $table->timestamps();

            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    public function down()
    {
        Schema::dropIfExists('events');
    }
}
