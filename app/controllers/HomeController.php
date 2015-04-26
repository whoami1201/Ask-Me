<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function getIndex() { 

    	return View::make('qa.index');

    }

    public function getBrowse() {
    	return View::make('qa.browsee')
    	->with('title','All questions')
    	->with('questions',Question::with('users','tags','answers')
    		->orderBy('id','desc')->paginate(4));
    }


}
