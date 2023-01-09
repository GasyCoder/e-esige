<?php

class ClassesController extends BaseController {

	public function index()
	{
		$title = 'Niveaux';
		$niveau = TheClass::all();
		return View::make('admin.niveau.index', compact('niveau'))->with('title', $title);
	}


	public function store()
	{
		if (Request::ajax()){

			$inputs = Input::all();
			$validation = Validator::make($inputs, ['name'=>'required']);
			if ($validation->fails()) {
				return 'false';
			} 
			else {
				$class = TheClass::create([

					'name' => ($inputs['name']),
					'short' => ($inputs['short']),
                    'note' => ($inputs['note'])
				]);

				return 'true';
			}
        }
	}

	public function update($id)
	{
		if (Request::ajax()){

			$inputs = Input::all();
			$validation = Validator::make($inputs, ['name'=>'required|string']);
			if ($validation->fails()) {
				return 'false';
			} 

			else {
				$up = TheClass::find($id);

				$up->name 	= ($inputs['name']);
				$up->short 	= ($inputs['short']);
              	$up->note 	= ($inputs['note']);
			}
			if (Input::has('status'))
			   {
			    $up->status = 1;

			   }else {
			   $up->status = 0;
			}
		$up->save();
		return 'true';

        }
	}

}
