<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{

    public function up()
    {
        Schema::create('events', function (Blueprint $table) {

          $table->bigIncrements('id')->unsigned();
          $table->string('title', 40);
          $table->string('description', 120);
          $table->datetime('ts_start');
          $table->datetime('ts_end');
          $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('events');
    }
}
