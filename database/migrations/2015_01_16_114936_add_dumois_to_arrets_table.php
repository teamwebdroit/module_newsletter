<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddDumoisToArretsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('arrets', function(Blueprint $table)
		{
			$table->boolean('dumois')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('arrets', function(Blueprint $table)
		{
			$table->dropColumn('dumois');
		});
	}

}
