<?php

class AnswersController extends \BaseController {

	/**
	 * Adds a reply to the questions
	**/
	public function postReply($id,$title) {

		// Check question id is valid
		$question = Question::find($id);

		// If found
		if ($question) {
			// Form validation
			$validation = Validator::make(Input::all(), Answer::$add_rules);

			if($validation->passes()) {
				// Create answer
				Answer::create(array(
					'question_id' => $question->id,
					'user_id' => Sentry::getUser()->id,
					'answer' => Input::get('answer')
					));

				// Redirect user to question detail page with success message
				return Redirect::route('question_details',array($id,$title))
				->with('success', 'Answer submitted successfully!');
			} else {

				// If unvalid
				return Redirect::route('question_details',array($id,$title))
				->with('error', $validation->errors()->first());
			}

		} else {
			// If not found
			return Redirect::route('index')
			->with('error','Question not found!');
		}
	}
}
