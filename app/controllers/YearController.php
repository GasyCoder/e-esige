<?php

class YearController extends BaseController {

	public function index()
	{
		$title          = 'Année Universitaire';
		$years 	    	= Year::orderBy('id', 'asc')->paginate(15);

		return View::make('admin.years.index', compact('years'))->with('title', $title);
	}

	public function storeYear()
	{
		if (Request::ajax()){

	
			$inputs = Input::all();
			$validation = Validator::make($inputs, ['yearsUniv' => 'required']);
			if ($validation->fails()) {
				return 'false';
			} 

			else {
				$year = Year::create([

					'dateStart' => ($inputs['dateStart']),
					'dateEnd'   => ($inputs['dateEnd']),
					'yearsUniv' => ($inputs['yearsUniv'])
				]);

				return 'true';
			}

        }
	}


	public function updateYear($id)
	{
		if (Request::ajax()){
			$inputs = Input::all();
			$validation = Validator::make($inputs, ['yearsUniv' => 'required']);
			if ($validation->fails()) {
				return 'false';
			} 
			else {
				$year 				= Year::find($id);
				$year->dateStart 	= ($inputs['dateStart']);
				$year->dateEnd 		= ($inputs['dateEnd']);
				$year->yearsUniv 	= ($inputs['yearsUniv']);
			}

			if (Input::has('status'))
			   {
			    $year->status = 1;
			  }
			else {
			    $year->status = 0;
			  }

			$year->save();
			return 'true';

        }
	}

	public function delete($id)
	{
		$year = Year::find($id);
		if ($year !== null) {
			$year->delete();
			$path = Session::get('language');
			return Redirect::route('index')->with('success', ('Parcour a été supprimé avec succès!'));
		} 

		else {
			return Redirect::back();
		}
	}


}
