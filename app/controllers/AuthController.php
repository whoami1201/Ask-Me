<?php

class AuthController extends \BaseController {

	/**
	 * Signup GET method.
	 */
	public function getSignup() {
		return View::make('qa.signup')->with('title','Sign up');
	}
	
	/**
	* Signup POST method
	*/
	public function postSignup() {
		// Validate the form
		$validation = Validator::make(Input::all(), User::$signup_rules);

		// check if validation passed
		if ($validation->passes()) {
			// Create user with Sentry 2's create method
			$user = Sentry::getUserProvider()->create(array(
				'email' => Input::get('email'),
				'password' => Input::get('password'),
				'first_name' => Input::get('first_name'),
				'last_name' => Input:: get('last_name'),
				'activated' => 1
				));

			// Haven't implemented email validation yet
			// Log user to database directly
			$login = Sentry::authenticate(array(
				'email'=>Input::get('email'),
				'password' =>Input::get('password')
				));
			return Redirect::route('index')->with('success','You\'ve signed up and logged in successfully!');
		} else {
			// If failed, return the form with error message
			return Redirect::route('signup_form')
			->withInput(Input::except('password','re_password'))
			->with('error',$validation->errors()->first());
		}


	}


}
