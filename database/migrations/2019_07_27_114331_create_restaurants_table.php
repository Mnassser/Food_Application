<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRestaurantsTable extends Migration {

	public function up()
	{
		Schema::create('restaurants', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('district_id');
			$table->integer('category_id');
			$table->string('image')->nullable();
			$table->string('name');
			$table->decimal('minimum_charge', 8,2);
			$table->decimal('delivery', 8,2);
			$table->string('phone');
			$table->string('whatsapp');
			$table->string('email');
			$table->string('password');
			$table->timestamps();
			$table->enum('status', array('0', '1'));
			$table->tinyInteger('activated');
			$table->string('api_token')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('restaurants');
	}
}