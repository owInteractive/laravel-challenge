<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('events', function (Blueprint $table)
		{
			$table->increments('id');
			$table->string('title');
			$table->text('description');
			$table->dateTime('start_at');
			$table->dateTime('end_at');
			$table->integer('user_id')
				->unsigned()
				->nullable();
			$table->foreign('user_id')
				->references('id')
				->on('users')
				->onDelete('set null')
				->onUpdate('set null');
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
		Schema::dropIfExists('events');
	}
}
