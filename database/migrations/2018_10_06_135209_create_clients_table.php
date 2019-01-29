<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name', 255);
			$table->string('email', 255);
			$table->date('birth_date');
			$table->integer('city_id');
			$table->string('mobile_number');
			$table->string('password');
			$table->date('last_donation_date');
			$table->enum('blood_type', array('O-','O+','B-','B+','A+','A-','AB-','AB+'));
			$table->string('api_token', 60)->nullable();
			$table->string('pin_code')->nullable();
			//$table->string('reset_code')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}