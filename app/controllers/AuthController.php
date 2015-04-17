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

	/**
	* Login POST method Resource
	**/
	public function postLogin() {
		// validate the form
		$validation = Validator::make(Input::all(), User::$login_rules);

		// if validation fails, return to browse page with error message
		if ($validation->fails()) {
			return Redirect::route('signup_form')
			->withInput(Input::except('password'))
			->with('topError', $validation->errors()->first());
		} else {
			// if okay, authenticate user
			try {
					// Set login credentials
					$credentials = array(
					'email' =>Input::get('email'),
					'password' => Input::get('password')
					);
					// Try authenticate user, remember me is set to false
					$user = Sentry::authenticate($credentials, false);
					return Redirect::route('browse')->with('success','You have logged in successfully.');

				} catch (Cartalyst\Sentry\Users\LoginRequiredException $e) {
				return Redirect::route('signup_form')    
				->withInput(Input::except('password'))->with('topError','Login field is required.');
				} catch (Cartalyst\Sentry\Users\PasswordRequiredException $e) {      
					return Redirect::route('signup_form')
					->withInput(Input::except('password'))->with('topError','Password field is required.');
				} catch (Cartalyst\Sentry\Users\WrongPasswordException $e) {      
					return Redirect::route('signup_form')
					->withInput(Input::except('password'))->with('topError','Wrong password, please try again.');
				} catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {      
					return Redirect::route('signup_form')
					->withInput(Input::except('password'))->with('topError','User not found.');
				} catch (Cartalyst\Sentry\Users\UserNotActivatedException $e) {      
					return Redirect::route('signup_form')
					->withInput(Input::except('password'))->with('topError','User not activated.');
				}
		}
	}

	/**
	* Logout method
	**/
	public function getLogout(){
		Sentry::logout();
		return Redirect::route('browse')->with('success','You\'ve successfully logged out. See you around!');
	}



}
