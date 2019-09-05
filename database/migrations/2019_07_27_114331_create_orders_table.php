<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('client_id');
			$table->string('address');
			$table->string('special_order');
			$table->string('notes')->nullable();
			$table->decimal('total_price', 8,2);
			$table->decimal('additional_cost', 8,2);
			$table->enum('payment', array('1', '2'));
			$table->enum('status', array('pending', 'accepted', 'rejected', 'delivered', 'declined'));
			$table->decimal('commission', 8,2);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}