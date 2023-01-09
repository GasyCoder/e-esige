<?php 
class TarifController extends BaseController 
{
    
    public function index () {
        $title = 'Trifs d\'colage';
        $classes = TheClass::all();
        $tarifs = Tarif::all();
        return View::make('admin.tarifs.index', compact('tarifs', 'classes'))->with('title', $title);
    }

    //store data
    public function store(){
        
        if (Request::ajax()){

			$inputs = Input::all();
			$validation = Validator::make($inputs, ['class_id'=>'required', 'total'=>'required']);
			if ($validation->fails()) {
				return 'false';
			} 

			else {
	
				$ecolage = Tarif::create([

					'class_id' 	=> ($inputs['class_id']),
					'total' 	=> ($inputs['total']),
					'ecolage' 	=> ($inputs['ecolage']),
					'droit' 	=> ($inputs['droit']),
                    'status' 	=> ($inputs['status'])
				]);

				return 'true';
			}

        }

    }

    //Update date tarif
    public function update($id){

       if (Request::ajax()){

			$inputs = Input::all();
			$validation = Validator::make($inputs, ['class_id'=>'required', 'total'=>'required']);
			if ($validation->fails()) {
				
				return 'false';
			} 

			else {

				$ecoT = Tarif::find($id);

				$ecoT->class_id 	= ($inputs['class_id']);
				$ecoT->total 		= ($inputs['total']);
				$ecoT->ecolage 		= ($inputs['ecolage']);
				$ecoT->droit 		= ($inputs['droit']);
			  }
			
			if (Input::has('status'))
				   {
				    $ecoT->status = 1;
				   }
				   else {
				   $ecoT->status = 0;
				}

			$ecoT->save();
			return 'true';

        }
    }

    /*
    // Detele data from table tarifs
    */

    public function delete($id){

       $tarif = Tarif::find($id);

		if ($tarif !== null) {
			$tarif->delete();
			$path = Session::get('language');
			return Redirect::back()->with('success', Lang::get($path.'.Deleted_successfully'));
		} 

		else {
			return Redirect::back();
		}

    }
}
