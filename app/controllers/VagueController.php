<?php 

class VagueController extends BaseController
{
	
	public function index()
	{
		$title = 'Vagues';
		$vagues = Vague::all();
		return View::make('admin.vagues.index', compact('vagues'))->with('title', $title);
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
				$vague = Vague::create([

					'name' 		=> ($inputs['name']),
					'abr' 		=> ($inputs['abr']),
                    'dateStart' => ($inputs['dateStart']),
                    'dateEnd' 	=> ($inputs['dateEnd']),
                    'note' 		=> ($inputs['note'])
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
				$up = Vague::find($id);

				$up->name 		= ($inputs['name']);
				$up->abr 		= ($inputs['abr']);
              	$up->dateStart 	= ($inputs['dateStart']);
              	$up->dateEnd 	= ($inputs['dateEnd']);
              	$up->note 		= ($inputs['note']);
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