<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class payment extends Migration {

    public function up()
    {
        Schema::create('payment', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('restaurant_id');
            $table->integer('paied');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('payment');
    }
}