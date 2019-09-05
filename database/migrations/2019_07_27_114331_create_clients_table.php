<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('district_id');
			$table->string('name');
			$table->string('email');
			$table->string('password');
			$table->string('phone');
			$table->string('image')->nullable();
			$table->timestamps();
			$table->string('api_token')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}