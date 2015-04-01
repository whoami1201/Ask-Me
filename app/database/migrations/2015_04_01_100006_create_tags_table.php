<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tags', function(Blueprint $table)
		{
			// id is needed to match pivot
			$table->increments('id');

			// Tag's name
			$table->string('tag')->default('');

			// Tag's URL-friendly name
			$table->string('tag_friendly')->unique();

			// Keep timestamps
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
		Schema::table('tags', function(Blueprint $table)
		{
			Schema::drop('tags');
		});
	}

}
