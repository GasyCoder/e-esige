<?php 

class ProfilController extends BaseController
{
	
	public function index()
	{
		$title = 'Panel étudiant';

		//$token = Auth::user()->token;

		return View::make('components.panel')->with('title', $title);
	}
}