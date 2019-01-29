<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactUsTable extends Migration {

	public function up()
	{
		Schema::create('contact_us', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name', 255);
			$table->string('email', 255);
			$table->string('title', 255);
			$table->text('text');
			$table->string('mobile_number', 255);
			$table->string('api_token', 60)->nullable();
		});
	}

	public function down()
	{
		Schema::drop('contact_us');
	}
}