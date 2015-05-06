<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('questions', function(Blueprint $table)
		{
			// Question's ID
			$table->increments('id');

			// Title of question
			$table->string('title',400)->default('');
			
			// Asker's id
			$table->integer('user_id')->unsigned()->default(0);

			// Question's details
			$table->text('question')->default('');

			// How many times it's been viewed
			$table->integer('viewed')->unsigned()->default(0);

			// Total number of votes
			$table->integer('votes')->default(0);

			// Foreign key to match userID (asker's id) to users
			$table->foreign('user_id')->references('id')
			->on('users')->onDelete('cascade');

			// get asking time from created_at column
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
		Schema::table('questions', function(Blueprint $table)
		{
			// Destroy table
			Schema::drop('questions');
		});
	}

}
