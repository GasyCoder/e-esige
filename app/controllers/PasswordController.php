<?php

class PasswordController extends BaseController {

	


	public function remind()
	{
		return View::make('auth.password_reset');
	}

	public function request()
	{	

		$path = Session::get('language');

		if ($credentials = array('email' => Input::get('email'), 'password' => Input::get('password'))) {

			$credentials = array('email' => Input::get('email'), 'password' => Input::get('password'));
	
			$check = DB::table('users')->where('email', $credentials['email'])->first();

			if ( count($check) == 1 ) {


				$control = Control::find(1);
				$univ_name = $control->univ_name;

				$from = 'no-reply@'.$_SERVER['SERVER_NAME'];


			//	Password::remind($credentials);
				Password::remind(Input::only('email'), function($message) use ($from, $univ_name) {

    				$message->from($from, $univ_name);

				    $message->subject('Réinitialisez votre mot de passe.');
				    
				});

				return Redirect::back()->with('success', Lang::get($path.'.reset_code_send') );

			}

			else {
				return Redirect::back()->with('error', Lang::get($path.'.no_user_with_this_email'));
			}
		   

		} 

		
	  
	}


	public function reset($token)
	{
	  
		$email = DB::table('password_reminders')->where('token', $token)->first();

		if (count($email) >= 1 ) {

			return View::make('auth.password_reset_link', compact('token', 'email'));
		} 

		else {
			return View::make('auth.password_reset_error');
		}
		

	}

	public function update()
	{
		$inputs = Input::all();

		$check = DB::table('password_reminders')->where('token', $inputs['token'])->where('email', $inputs['email'])->first();

		if ( count($check) == 1 ) {
			$user_id = DB::table('users')->where('email', $check->email)->first();

			$user = User::find($user_id->id);

			$user->password = Hash::make($inputs['password']);
			$user->save();

			// delete form password_reminders table();
			DB::table('password_reminders')->where('email', $inputs['email'])->delete();

			$path = Session::get('language');

			return Redirect::route('login')->withSuccess(Lang::get($path.'.reset_success'));


		}
	


	}



}
