<?php

class HomeController extends BaseController {

protected $layouts = 'layouts.master';

	public function showWelcome()
	{
		$control = Control::find(1);
		return View::make('auth.login');
	}

    
    //This function is when this app disabled
    public function close()
	{
		$control = Control::find(1);
		if ($control->close_site == 0) {
			return Redirect::route('login');
		} 
		else {
			$msg = $control->closing_msg;
			return View::make('close', compact('msg'));
		}
	}

}
