<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFavoritesTable extends Migration {

	public function up()
	{
		Schema::create('favorites', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('client_id');
			$table->string('article_id');
		});
	}

	public function down()
	{
		Schema::drop('favorites');
	}
}