<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOffersTable extends Migration {

	public function up()
	{
		Schema::create('offers', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('restaurant_id');
			$table->string('image');
			$table->string('name');
			$table->string('description')->nullable();
			$table->date('start');
			$table->date('end');
		});
	}

	public function down()
	{
		Schema::drop('offers');
	}
}