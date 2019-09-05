<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactsTable extends Migration {

	public function up()
	{
		Schema::create('contacts', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('email');
			$table->string('phone');
			$table->string('message');
			$table->enum('type', array('1', '2', '3'));
			$table->timestamps();
			$table->string('contactable_type');
			$table->integer('contactable_id');
		});
	}

	public function down()
	{
		Schema::drop('contacts');
	}
}