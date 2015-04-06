<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
/**
* This method is to create an admin once.
* Just run it once, and then remove or comment it out.
**/
// Route::get('create_user',function()
// {
// 	$user = Sentry::getUserProvider()->create(array( 
// 		'email' => 'admin@admin.com',
// 		//password will be hased upon creation by Sentry 2
// 		'password' => 'password',
// 		'first_name' => 'Admin',
// 		'last_name' => 'Laravel',
// 		'activated' => 1,
// 		'permissions' => array (
// 			'admin' => 1
// 			)
// 	));
// 	return 'admin created with id of '.$user->id;
// });
// Auth Resource
Route::get('signup', array(
	'as'=>'signup_form', 
	'before' => 'is_guest',
	'uses'=>'AuthController@getSignup'
	));

Route::post('signup', array(
	'as'=>'signup_form_post',
	'before' => 'csrf|is_guest',
	'uses' => 'AuthController@postSignup'
	));

Route::post('login', array(
	'as'=>'login_post', 
	'before' => 'csrf| is_guest',
	'uses' => 'AuthController@postLogin'
	));

Route::get('logout', array(
	'as' => 'logout',
	'before' => 'user',
	'uses' => 'AuthController@getLogout'
	));

//--- Q&A Resources
//------HOMEPAGE--------
Route::get('/', array(
	'as'=>'index',
	'uses' => 'HomeController@getIndex'
	));

//------ASK--------
Route::get('ask',array(
	'as'=>'ask',
	'before'=>'user',
	'uses'=>'QuestionsController@getNew'
	));

Route::post('ask',array(
	'as'=>'ask_post',
	'before'=>'user|csrf',
	'uses'=>'QuestionsController@postNew'
	));

//------BROWSE--------
Route::get('browse',array(
	'as'=>'browse',
	'uses'=>'HomeController@getBrowse'
	));

//------QUESTION DETAILS-------
Route::get('question/{id}/{title}', array(
	'as'=>'question_details',
	'uses'=>'QuestionsController@getDetails'
	))->where(array('id'=>'[0-9]+', 'title'=>'[0-9a-zA-Z\-\_]+'));


//------FUNCTIONS---------------
//Upvoting and Downvoting 
Route::get('question/vote/{direction}/{id}',array('as'=>   
      'vote', 'before'=>'user', 'uses'=>   
      'QuestionsController@getvote'))->where   
      (array('direction'=>'(up|down)', 'id'=>'[0-9]+')); 

//Question tags page 
Route::get('question/tagged/{tag}',array('as'=>  
      'tagged','uses'=>'QuestionsController@getTaggedWith'))->  
      where('tag','[0-9a-zA-Z\-\_]+'); 

//Reply Question
Route::post('question/{id}/{title}',array('as'=>  
      'question_reply','before'=>'csrf|user',   
      'uses'=>'AnswersController@postReply'))->  
      where(array('id'=>'[0-9]+','title'=>'[0-9a-zA-Z\-\_]+')); 

//Admin Question Deletion 
Route::get('question/delete/{id}',array('as'=>'  
      delete_question','before'=>'access_check:admin',  
      'uses'=>'QuestionsController@getDelete'))->  
      where('id','[0-9]+'); 