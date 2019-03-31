<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreatePolygonsTable.
 */
class CreatePolygonsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('polygons', function(Blueprint $table) {
			$table->increments('id');

			$table->integer('zone_id')->unsigned();
			$table->foreign('zone_id')->references('id')->on('zones');

			$table->decimal('latitude', 10, 7);
			$table->decimal('longitude', 10, 7);
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
		Schema::drop('polygons');
	}
}
