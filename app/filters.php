<?php

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function() {
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest('login');
		}
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});


// users in auth redirect to home
Route::filter('user_in_auth', function(){
	if (Auth::check()) {
		return Redirect::route('home');
	}
});

// Admin
Route::filter('admin', function(){
	if (Auth::check()) {
		if (!Auth::user()->is_admin) {
			return Redirect::route('home');
		}
		else {/**/}
	}
	else {
		return Redirect::route('auth.login');
	}
});


// Secretaire
Route::filter('secretaire', function(){
	if (Auth::check()) {
		if (!Auth::user()->is_secretaire) {
			return Redirect::route('home');
		}
		else {/**/}
	}
	else {
		return Redirect::route('auth.login');
	}
});


// Student
Route::filter('student', function(){
	if (Auth::check()) {
		if (!Auth::user()->is_student) {
			return Redirect::route('home');
		}
		else {/**/}
	}
	else {
		return Redirect::route('auth.login');
	}
});


// Teacher
Route::filter('teacher', function(){
	if (Auth::check()) {
		if (!Auth::user()->is_teacher) {
			return Redirect::route('home');
		}
		else {/**/}
	}
	else {
		return Redirect::route('auth.login');
	}
});


// if site is Closed
Route::filter('closed', function(){

	$control = Control::find(1);
	if ($control->close_site == 1) {
		return Redirect::route('auth.close');
	} 
});


/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() !== Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});


//-------------  error database -------------------//
App::error(function(PDOException $exception)
{
    Log::error("Error connecting to database: ".$exception->getMessage());
    return "Error connecting to database";

});


// check if db connected
Route::filter('db_connected', function(){
	try {
		$db = DB::connection()->getPdo();
		if (DB::connection()->getDatabaseName()) {
			return Redirect::route('home');
		} else { }
	} catch (\Exception $e) {
	}
});

App::after(function($request, $response)
{
	//
});