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
Route::group(['before'=>'closed'], function(){
	// ------> home the first page show in this app
	Route::get('/', ['as'=>'home', 'uses'=>'HomeController@showWelcome']);
});

//--------> if users in auth redirect to home
Route::group(['before'=>'user_in_auth'], function(){

		// ------> login
		Route::get('/', ['as'=>'login', 'uses'=>'UserController@login']);
		Route::post('check', ['as'=>'auth.check', 'uses'=>'UserController@check']);

		// ------> password forgot
		Route::get('password/reset', ['as'=>'remind_users_reset', 'uses'=>'PasswordController@remind']);
		Route::post('password/reset', ['as'=>'remind_password_request', 'uses'=>'PasswordController@request']);
		Route::get('password/reset/{token}', ['as'=>'remind_password_reset', 'uses'=>'PasswordController@reset']);
		Route::post('password/reset/{token}', ['as'=>'remind_password_update', 'uses'=>'PasswordController@update']);
});
Route::get('logout', ['as'=>'logout', 'uses'=>'UserController@logout']);

//--> only admin can access here
Route::group(['before'=>'admin'], function(){
	Route::get('admin', ['as'=>'panel.admin', 'uses'=>'AdminController@index']);

});