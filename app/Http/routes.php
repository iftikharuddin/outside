<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function(){
	return view('welcome');
});
Route::get('/', [
    'uses' => 'PostController@getDashboard'
	
	]);
Route::post('/signup', 'UserController@postSignUp');

Route::post('/signin', 'UserController@postSignIn');
Route::group(['middleware' => 'auth'], function(){
	
	Route::post('/upateaccount', [
		'uses' => 'UserController@postSaveAccount'
		
	]);
	Route::get('/account', [
    'uses' => 'UserController@getAccount'
	
	]);
	Route::post('/like', [
    	'uses' => 'PostController@postLikePost'
	]);
	
	Route::get('/logout', 'UserController@getLogout');

	Route::post('/createpost', [ 'uses'=> 'PostController@postCreatePost']);
	Route::post('/createpost/{statusId}', [ 'uses'=> 'PostController@postReply']);

	Route::get('/deletepost/{post_id}', ['uses'=> 'PostController@getDeletePost']);

	Route::post('/edit', [
		'uses' => 'PostController@postEditPost',
		'as' => 'edit'
		
	]);
	
	Route::get('/search', 'SearchController@getResults');
	
	Route::get('/user/{username}', 'ProfileController@getProfile');
	Route::get('/friends', 'FriendController@getIndex');
	Route::get('/friends/add/{username}', 'FriendController@getAdd');
	Route::get('/friends/accept/{username}', 'FriendController@getAccept');
	
});