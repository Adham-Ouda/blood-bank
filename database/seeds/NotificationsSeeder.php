<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class NotificationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        /*Schema::table('notifications', function (Blueprint $table){
            $table->datetime('notification_time');
            $table->string('api_token', 60)->nullable();*/

		/*Schema::create('notifications', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->text('details');
			$table->datetime('notification_time');
			$table->integer('donation_order_id')->unsigned();
			$table->foreign('donation_order_id')->references('id')->on('donation_orders');
			$table->string('api_token', 60)->nullable();
		});	*/
        


    }
}
