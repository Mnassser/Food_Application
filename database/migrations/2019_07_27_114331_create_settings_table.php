<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->increments('id');
			$table->string('about');
			$table->string('elahly_bank');
			$table->string('alrajhi_bank');
			$table->string('commission_details');
			$table->string('email');
			$table->string('phone');
			$table->string('facebook')->nullable();
			$table->string('instagram')->nullable();
			$table->string('twitter');
			$table->string('linkedin')->nullable();
			$table->string('youtube')->nullable();
			$table->string('google')->nullable();
			$table->string('whatsapp')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}