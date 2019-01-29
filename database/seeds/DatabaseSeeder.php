<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        //$this->call(favorites::class);
        //$this->call(NotificationsSeeder::class);
        
        /*Schema::table('favorites', function (Blueprint $table) {
         $table->unsignedInteger('client_id');

         $table->foreign('client_id')->references('id')->on('clients');

         $table->unsignedInteger('article_id');

         $table->foreign('article_id')->references('id')->on('articles');
        }); */
        
        /* Schema::table('users', function (Blueprint $table) {
         
         $table->string('email');
         $table->timestamp('email_verified_at')->nullable();
         $table->timestamps();

        }); */

       /* Schema::table('settings', function (Blueprint $table){

            $table->increments('id');
            $table->string('name');
            $table->text('content');
            $table->string('address');
            $table->string('mobile_number');
            $table->string('phone');
            $table->string('website');
            $table->text('social_media_channels');
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->timestamps();
        });   */
        
      /*  Schema::table('settings', function (Blueprint $table){

           $table->string('email');
        });   */

         Schema::table('tokens', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('token', 500);
            $table->string('platform', 255);
            $table->integer('tokenable_id');
            $table->string('tokenable_type', 255);
        });

    }
}
