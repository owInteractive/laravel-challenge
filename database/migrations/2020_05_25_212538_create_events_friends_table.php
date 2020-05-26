<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsFriendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events_friends', function (Blueprint $table) {
            $table->integer('event_id')->unsigned();
            $table->integer('friend_user_id')->unsigned();
            $table->string('friend_email');
            $table->primary(['event_id', 'friend_user_id', 'friend_email']);
            $table->foreign('event_id')->references('id')->on('basic_events');
            $table->foreign(['friend_user_id', 'friend_email'])->references(['user_id', 'email'])->on('friends');
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
        Schema::dropIfExists('events_friends');
    }
}
