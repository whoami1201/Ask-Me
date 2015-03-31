<?php

class User extends Cartalyst\Sentry\Users\Eloquent\User {
	public static $signup_rules = array(
		'first_name' => 'required|min:2',
		'last_name' => 'required|min:2',
		'email'=> 'required|email|unique:users,email',
		'password' => 'required|min:6',
		're_password' => 'required|same:password'
		);
}