<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

	public function up()
	{
		Schema::create('products', function(Blueprint $table) {
			$table->increments('id');
			$table->string('image');
			$table->string('name');
			$table->string('description');
			$table->time('prep_time');
			$table->decimal('price', 8,2);
			$table->decimal('discount_price', 8,2);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('products');
	}
}