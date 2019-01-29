<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDonationOrdersTable extends Migration {

	public function up()
	{
		Schema::create('donation_orders', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->string('hospital');
			$table->integer('city_id');
			$table->string('age');
			$table->enum('blood_type', array('O-','O+','B-','B+','A+','A-','AB-','AB+'));
			$table->integer('number_cases');
			$table->string('mobile_number', 255);
			$table->string('hospital_address', 255);
			$table->text('notes')->nullable();
			$table->integer('client_id');
			$table->double('latitude')->nullable();
			$table->double('longitude')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('donation_orders');
	}
}