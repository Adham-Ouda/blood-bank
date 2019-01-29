<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCitiesTable extends Migration {

	public function up()
	{
		Schema::create('cities', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('city', 255);
			$table->integer('governorate_id')->unsigned();
			$table->foreign('governorate_id')->references('id')->on('governorates');
		});
	}

	public function down()
	{
		Schema::drop('cities');
	}
}