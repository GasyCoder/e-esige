<?php

class UserController extends BaseController {

protected $layouts = 'layouts.master';

	protected $user_rules = [	
			'email'=>'email|required|unique:users',
			'password'=>'required|min:6'

	];

	public function login()
	{
		return View::make('auth.login');
	}

	public function logout() {
		Auth::logout();
		return Redirect::route('home');
	}
	
	public function check()
	{
		$inputs = Input::all();

		$email 		= e($inputs['email']);
		$password 	= e($inputs['password']);

		$validation = Validator::make($inputs, ['email'=>'required', 'password'=>'required']);

		if ($validation->fails()) {

			return Redirect::back()->withErrors($validation);

		} else {
			if (Auth::attempt(['email'=>$email, 'password'=>$password])) {

				Auth::attempt(['email'=>$email, 'password'=>$password]);

				if (Auth::check()) {

					if(Auth::user()->is_admin) {
						return Redirect::route('panel.admin');
					}
					elseif(Auth::user()->is_student) {
						return Redirect::route('panel.student');
					}
					elseif(Auth::user()->is_teacher) {
						return Redirect::route('panel.teacher');
					}
					else {
						return Redirect::route('auth.login');
					}
				}
			} else {
				return Redirect::back()->with('error', ('Nous n\'avons pas pu vous connecter!'));
			}
		}
	}
}
