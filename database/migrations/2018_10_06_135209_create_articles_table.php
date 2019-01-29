<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArticlesTable extends Migration {

	public function up()
	{
		Schema::create('articles', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('title', 255);
			$table->text('body');
			$table->string('image', 255)->nullable();
			$table->integer('articles_category_id')->unsigned();
			$table->foreign('articles_category_id')->references('id')->on('articles_category');

		});
	}

	public function down()
	{
		Schema::drop('articles');
	}
}