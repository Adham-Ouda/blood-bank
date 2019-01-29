<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArticlesCategoryTable extends Migration {

	public function up()
	{
		Schema::create('articles_category', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('category_name', 255);
			//$table->integer('article_id');
		});
	}

	public function down()
	{
		Schema::drop('articles_category');
	}
}