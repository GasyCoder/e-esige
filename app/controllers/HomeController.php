<?php

class HomeController extends BaseController {


	public function login()
	{
		return View::make('auth.login');

	}


}
