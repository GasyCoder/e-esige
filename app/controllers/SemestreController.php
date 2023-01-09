<?php

class SemestreController extends BaseController {

	public function index()
	{
		$title 			= 'Semestres Universitaire';
		$years  		= Year::where('status', 1)->get();
		$semestres 	    = Semestre::orderBy('id', 'asc')->paginate(15);
		return View::make('admin.semestres.index', compact('semestres', 'years'))->with('title', $title);
	}


	public function storeSem()
	{
		if (Request::ajax()){
			$inputs = Input::all();
			$validation = Validator::make($inputs, ['semestre'=>'required']);
			if ($validation->fails()) {
				return 'false';
			} 
			else {
				$sem = Semestre::create([

					'semestre' 	=> ($inputs['semestre']),
					'yearsUniv' => ($inputs['yearsUniv']),
					'dateStart' => ($inputs['dateStart']),
					'dateEnd' 	=> ($inputs['dateEnd'])

				]);
				return 'true';
			}
        }
	}


	public function updateSem($id)
	{
		if (Request::ajax()){
			$inputs = Input::all();
			$validation = Validator::make($inputs, ['semestre'=>'required']);
			if ($validation->fails()) {
				return 'false';
			} 
			else {
				$sem = Semestre::find($id);

				$sem->semestre 		= ($inputs['semestre']);
				$sem->yearsUniv 	= ($inputs['yearsUniv']);
				$sem->dateStart 	= ($inputs['dateStart']);
				$sem->dateEnd 		= ($inputs['dateEnd']);
			}
			if (Input::has('status'))
			   {
			    $sem->status = 1;
			  }
			else {
			    $sem->status = 0;
			  }
			$sem->save();
			return 'true';
        }
	}

	public function delete($id)
	{
		$sem = Semestre::find($id);
		if ($sem !== null) {
			$sem->delete();
			$path = Session::get('language');
			return Redirect::route('index')->with('success', ('Semestre a été supprimé avec succès!'));
		} 
		else {
			return Redirect::back();
		}
	}


}
