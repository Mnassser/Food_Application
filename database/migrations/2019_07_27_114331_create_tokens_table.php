<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTokensTable extends Migration {

	public function up()
	{
		Schema::create('tokens', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('tokenable_type');
			$table->integer('tokenable_id')->nullable();
			$table->enum('platform', array('android', 'ios'));
			$table->string('token');
		});
	}

	public function down()
	{
		Schema::drop('tokens');
	}
}