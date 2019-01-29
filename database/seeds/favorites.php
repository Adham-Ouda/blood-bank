<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class favorites extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Schema::table('favorites', function (Blueprint $table) {
         $table->unsignedInteger('client_id');

         $table->foreign('client_id')->references('id')->on('clients');

         $table->unsignedInteger('article_id');

         $table->foreign('article_id')->references('id')->on('articles');
        });

       });
      }
}
