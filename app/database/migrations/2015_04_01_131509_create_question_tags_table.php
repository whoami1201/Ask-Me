<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionTagsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('question_tags', function(Blueprint $table)
		{
			Schema::create('question_tags', function(Blueprint $table){
				$table->increments('id');

				$table->integer('question_id')->unsigned()->default(0);
				$table->integer('tag_id')->unsigned()->default(0);

				$table->foreign('question_id')->references('id')
				->on('questions')->onDelete('cascade');

				$table->foreign('tag_id')->references('id')
				->on('tags')->onDelete('cascade');

				$table->timestamps();
			});
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('question_tags', function(Blueprint $table)
		{
			Schema::drop('question_tags');
		});
	}

}
