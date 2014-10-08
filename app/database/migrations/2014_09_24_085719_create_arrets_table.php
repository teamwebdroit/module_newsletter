<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArretsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('arrets', function(Blueprint $table)
		{

            $table->increments('id')->unsigned();
            $table->integer('pid');
            $table->integer('user_id');
            $table->integer('deleted')->default(0);
            $table->string('reference');
            $table->dateTime('pub_date');
            $table->text('abstract')->nullable();
            $table->text('pub_text')->nullable();
            $table->text('file')->nullable();
            $table->integer('categories')->nullable();
            $table->text('analysis')->nullable();
			$table->timestamps();

		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('arrets');
	}

}
