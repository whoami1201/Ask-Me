<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('answers', function(Blueprint $table)
		{
			$table->increments('id');

			// question's id
			$table->integer('question_id')->unsigned()->default(0);

			// answer's user id
			$table->integer('user_id')->unsigned()->default(0);
			$table->text('answer');

			// if the question has been marked as correct
			$table->enum('correct',array('0','1'))->default(0);

			// total number of votes
			$table->integer('votes')->default(0);

			// foreign keys
			$table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
		Schema::table('answers', function(Blueprint $table)
		{
			//
		});
	}

}
