<?php

class ParcourController extends BaseController {

	public function index()
	{
		$title 		    = 'Listes des parcours';
		$classes  	= TheClass::all();
		$parcours 	= Parcour::orderBy('id', 'asc')->get();
        return View::make('admin.parcours.index', compact('parcours', 'classes'))->with('title', $title);
	}


	public function storeParcour()
	{
		if (Request::ajax()){

	
			$inputs = Input::all();
			$validation = Validator::make($inputs, ['name'=>'required']);
			
			if ($validation->fails()) {
				return 'false';
			} 

			else {
				$parcour = Parcour::create([

					'name' 		=> ($inputs['name']),
					'abr' 		=> ($inputs['abr']),
					'class_id' 	=> ($inputs['class_id']),
				]);
				
			if (Input::get('status'))

			    {
			        $parcour->status = 1;

			    }else {
			    	
			        $parcour->status = 0;
			    }

				return 'true';
			}

        }
	}


	public function updateParcour($id)
	{
		if (Request::ajax()){
			$inputs = Input::all();
			$validation = Validator::make($inputs, ['name'=>'required']);
			if ($validation->fails()) {
				return 'false';
			} 
			else {
				$parcour = Parcour::find($id);
				$parcour->name      = ($inputs['name']);
				$parcour->abr       = ($inputs['abr']);
				$parcour->class_id  = ($inputs['class_id']);
			}
			if (Input::has('status')) {
			         $parcour->status = 1;
			    } else {

			         $parcour->status = 0;
				}
				$parcour->save();
				return 'true';		
			}
		}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete($id)
	{
		
		$parcour = Parcour::find($id);
		if ($parcour !== null) {

			// delete parcour from Etudiant
			$students = Student::where('parcour_id', $parcour->id)->get();
			foreach ($students as $student) {
				$student->parcour_id = 0;
				$student->save();
			}

			$parcour->delete();
			$path = Session::get('language');
			return Redirect::back()->with('success', ('Parcour a été supprimé avec succès!'));
		} 

		else {
			return Redirect::back();
		}
		
	}


}
