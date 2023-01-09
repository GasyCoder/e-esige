<?php
class EcController extends BaseController {

	protected function makeSlug($string = null, $separator = "-") {
	    if (is_null($string)) {
	        return "";
	    }
	    $string = ucfirst($string);
	    $string = mb_strtolower($string, "UTF-8");
	    $string = preg_replace("/[\s-]+/", " ", $string);
	    $string = preg_replace("/[\s_]/", $separator, $string);

	    return $string;
	}

	public function index()
	{
		$title 			 = 'Elements Constitutifs';
		$sous            = 'Liste des niveaux';
		$parcours  		 = Parcour::where('status', 1)->orderBy('id', 'asc')->get();
		$classes  		 = TheClass::all();
		$etudiants 		 = Student::orderBy('id', 'asc')->paginate(10);
		$ues  	 	 	 = UE::all();
		$elementsC 		 = EC::orderBy('id', 'asc')->get();

		return View::make('admin.pedagogie.EC.index', compact('elementsC', 'etudiants', 'parcours', 'ues', 'classes', 'troncs'))->with('title', $title)->with('sous', $sous);
	}

	public function AddtroncCommun($class)
	{
		$title 			 	 = 'Matière tronc commun';
		$sous            	 = 'Elemenrts Constitutifs';
		$allClasses   		 = TheClass::where('id', '>=', 2)->where('status', 1)->orderBy('id', 'asc')->get();
		$class   			 = TheClass::find($class);
		$allParcours 		 = Parcour::where('class_id', $class->id)->where('status', 1)->orderBy('id', 'asc')->get();
		$allUes 			 = UE::where('tronc', 1)->where('status', 1)->get();
		$semestres   		 = Semestre::where('status', 1)->get();

		return View::make('admin.pedagogie.EC.addtronc', compact('class','allParcours', 'allClasses', 'allUes', 'semestres'))->with('title', $title)->with('sous', $sous);
	}


	public function saveTronc($class)
	{
		if (Request::ajax()) {
			$class   		= TheClass::find($class);
			$user_id        = Auth::user()->id;

			$inputs = Input::all();
			$validation = Validator::make($inputs, ['name'=>'required']);
			if ($validation->fails()) {
				return 'false';
			} 
			else {

			//$parcour = $inputs['parcour_id'];		
			foreach ($inputs['parcour_id'] as $parcour) {

				$tronc = new EC();
				
				$tronc->user_id 		= $user_id;
				$tronc->class_id    	= $class->id;
				$tronc->parcour_id    	= $parcour;

				$tronc->codeEc 			= $inputs['codeEc'];
				$tronc->name 			= $inputs['name'];
				$tronc->abr 			= $inputs['abr'];
				$tronc->slug 			= $this->makeSlug($inputs['name']);
				$tronc->volH 		    = $inputs['volH'];
				$tronc->coef 		    = $inputs['coef'];
				$tronc->codeUe 			= $inputs['codeUe'];
				$tronc->semestre 		= $inputs['semestre'];
				$tronc->tronc 			= 1;
				$tronc->save();

			 }
				return 'true';
			}

        }
	}


	public function ec_parcour($class)
	{
		$title 			 = 'Elements Constitutifs';
		$sous            = 'List des parcours';
		$class   		 = TheClass::find($class);
		$parcours 		 = Parcour::where('class_id', $class->id)->where('status', 1)->get();
		$ues 			 = UE::where('class_id', $class->id)
							->where('status', 1)->get();

		return View::make('admin.pedagogie.EC.parcours', compact('parcours', 'class', 'ues'))->with('title', $title)->with('sous', $sous);
	}

	public function storeEc($class, $parcour)
	{
		if (Request::ajax()) {

			$class   		= TheClass::find($class);
			$parcour 		= Parcour::find($parcour);
			$user_id        = Auth::user()->id;

			$inputs = Input::all();
			$validation = Validator::make($inputs, ['name'=>'required']);
			if ($validation->fails()) {
				return 'false';
			} 
			else {

				$ecs = new EC();
				
				$ecs->user_id 		= $user_id;
				$ecs->class_id    	= $class->id;
				$ecs->parcour_id    = $parcour->id;
				$ecs->al_value      = $parcour->id;

				$ecs->codeEc 		= $inputs['codeEc'];
				$ecs->name 			= $inputs['name'];
				$ecs->abr 			= $inputs['abr'];

				$ecs->slug 			= $this->makeSlug($inputs['name']);

				$ecs->volH 		    = $inputs['volH'];
				$ecs->coef 		    = $inputs['coef'];
				$ecs->codeUe 		= $inputs['codeUe'];
				$ecs->semestre 		= $inputs['semestre'];
				$ecs->status 		= 1;
				$ecs->save();

				return 'true';
			}

        }
	}

	public function addTeacher_ec($class, $parcour, $id)
	{	
		$title          = 'Ajouter Enseignant';
		$sous           = 'Element Constitutifs';
		$class   		= TheClass::find($class);
		$parcour 		= Parcour::find($parcour);

		$teachers 		= Teacher::all();

		//$element 		= base64_decode(str_pad(strtr($element, '-_', '+/'), strlen($element) % 4, '=', STR_PAD_RIGHT));
		$element 		= EC::find($id);
		
		$allmatieres 		= EC::where('status', 1)
									->where('class_id', 	$class->id)
									->where('parcour_id', 	$parcour->id)
									->where('id', '!=', 	$element->id)
									->get();

		$autreparcours 		= Parcour::where('status', 1)
										->where('class_id', $class->id)
										->where('id', 		$parcour->id)
										->get();

		return View::make('admin.pedagogie.EC.addTeacher', compact('autreparcours', 'allmatieres', 'element', 'class', 'parcour', 'teachers'))->with('title', $title)->with('sous', $sous);
	} 


	public function ajouterTeacher($id)
	{
		if (Request::ajax()) {

			$inputs = Input::all();
			$validation = Validator::make($inputs, ['id_teacher'=>'required']);
			if ($validation->fails()) {
				return 'false';
			} 
			else {

				$teacher 				    = EC::find($id);
				$teacher->id_teacher 		= e($inputs['id_teacher']);
			}
			$teacher->save();
			return 'true';  
        }

	}

	//Teacher -- Add

	public function edit($class, $parcour, $element)
	{	
		$title          = 'Modifier';
		$sous           = 'Element Constitutifs';
		$class   		= TheClass::find($class);
		$parcour 		= Parcour::find($parcour);

		$element = base64_decode(str_pad(strtr($element, '-_', '+/'), strlen($element) % 4, '=', STR_PAD_RIGHT));
		$elements 		= EC::find($element);

		return View::make('admin.pedagogie.EC.update', compact('elements', 'class', 'parcour'))->with('title', $title)->with('sous', $sous);
	} 

	public function updateEc($id)
	{
		if (Request::ajax()) {

			$inputs = Input::all();
			$validation = Validator::make($inputs, ['name'=>'required']);
			if ($validation->fails()) {
				return 'false';
			} 
			else {

				$el 				= EC::find($id);
				$el->codeEc 		= e($inputs['codeEc']);
				$el->codeUe 		= e($inputs['codeUe']);
				$el->name 			= e($inputs['name']);
				$el->abr 			= e($inputs['abr']);
				$el->slug			= $this->makeSlug($inputs['name']);
				$el->volH 			= e($inputs['volH']);
				$el->coef 			= e($inputs['coef']);
				$el->tronc 			= e($inputs['tronc']);
				$el->semestre 		= e($inputs['semestre']);
			}
			if (Input::has('status'))
			   {
			      $el->status = 1;

			   }else {
			     $el->status = 0;
			  }

			$el->save();
			return 'true';  
        }

	}


	public function addnew($class, $parcour)
	{	
		$title 			= 'Liste des matières';
		$sous           = 'Element Constitutifs';
		$class   		= TheClass::find($class);
		$parcour 		= Parcour::find($parcour);
		$parcours 		= Parcour::where('class_id', $class->id)
									->where('id', '!=', $parcour->id)
									->where('status', 1)->get();

		$ec_s1 		= EC::where('class_id', $class->id)
							->where('parcour_id', $parcour->id)
							->where('semestre', 1)
							->orderBy('id', 'asc')
          					->get();

		$ec_s2 		= EC::where('class_id', $class->id)
							->where('parcour_id', $parcour->id)
							->where('semestre', 2)
							->orderBy('id', 'asc')
          					->get();					

		$NoMixte 	    = EC::where('tronc', 0)->where('class_id', $class->id)
							->where('parcour_id', $parcour->id)
							->orderBy('id', 'asc')
          					->count();

		$matiereMixte 	= EC::where('tronc', 1)->where('class_id', $class->id)
							->where('parcour_id', $parcour->id)
							->orderBy('id', 'asc')
          					->count();										

		$ues 		    = UE::where('tronc', 0)
							->where('parcour_id', $parcour->id)
							->where('class_id', $class->id)
							->where('status', 1)
							->orderBy('id', 'asc')
          					->get();
					

		$choixs   		= Choixs::where('status', 1)->get();
		$semes   		= Semestre::all();

		return View::make('admin.pedagogie.EC.addnew', compact('ec_s1', 'ec_s2', 'class', 'parcour', 'ues', 'matiereMixte', 'NoMixte', 'semestres', 'semes', 'choixs', 'parcours'))->with('title', $title)->with('sous', $sous);
	}


	public function checkElement($class, $parcour, $id)
	{
		$title 	  		= 'Détails de matière';
		$sous     		= 'Element Constitutifs';
		$class    		= TheClass::find($class);
		$parcour  		= Parcour::find($parcour);
		//$element  		= base64_decode(str_pad(strtr($id, '-_', '+/'), strlen($id) % 4, '=', STR_PAD_RIGHT));
		$element 		= EC::find($id);		
		$matieres 		= EC::where('class_id', 				$class->id)
										->where('parcour_id', 	$parcour->id)
										->where('codeEc', 		$element->codeEc)
										->where('id', 			$element->id)	
		                                ->where('status', 1)
		                                ->get();

		$troncs_egale   = EC::where('tronc', 1)
										->where('class_id', 			$class->id)
										->where('parcour_id', '!=', 	$parcour->id)
										->where('codeEc', 				$element->codeEc)	
		                                ->where('status', 1)
		                                ->get();
		$troncs   		= EC::where('tronc', 1)
										->where('class_id',   '!=',      $class->id)
										->where('parcour_id', '!=', 	 $parcour->id)
										->where('codeEc', 				 $element->codeEc)	
		                                ->where('status', 1)
		                                ->get();
		$unite 			= UE::where('class_id', 			$class->id)
			                        ->where('parcour_id', 	$parcour->id)
			                        ->where('codeUe',     	$element->codeUe)
			                        ->where('status', 1)
			                        ->first();

		$teacher  		= Teacher::where('id', $element->id_teacher)
									->first();

		return View::make('admin.pedagogie.EC.details', compact('class', 'unites', 'parcour', 'matieres', 'element', 'troncs', 'troncs_egale', 'teacher', 'unite'))->with('title', $title)->with('sous', $sous);
	}

	public function print_element($class, $parcour)
	{
		$title 	  = 'Mode impression';
		$sous     = 'Liste des matières';
		$class    = TheClass::find($class);
		$parcour  = Parcour::find($parcour);

		$matires_S1 = EC::where('class_id', $class->id)
										->where('parcour_id', $parcour->id)
		                                ->where('semestre', 1)
		                                ->orderBy('id', 'asc')
		                                ->get();

		$matires_S2 = EC::where('class_id', $class->id)
										->where('parcour_id', $parcour->id)
		                                ->where('semestre', 2)
		                                ->orderBy('id', 'asc')
		                                ->get();
		                                                                
       $mat_print = EC::where('tronc', 0)->where('class_id', $class->id)
										->where('parcour_id', $parcour->id)
		                                ->where('status', 1)
		                                ->orderBy('tronc')->count();

        $mat_print_mixte = EC::where('tronc', 1)->where('class_id', $class->id)
										->where('parcour_id', $parcour->id)
		                                ->where('status', 1)
		                                ->orderBy('tronc')->count();  

		return View::make('admin.pedagogie.EC.impression', compact('class', 'parcour', 'matires_S1', 'matires_S2', 'mat_print_mixte', 'mat_print'))->with('title', $title)->with('sous', $sous);
	}

	public function rajouter($class, $parcour, $element)
	{

		$class   		= TheClass::find($class);
		$parcour 		= Parcour::find($parcour);
		$element 	= base64_decode(str_pad(strtr($element, '-_', '+/'), strlen($element) % 4, '=', STR_PAD_RIGHT));

		$inputs 		= Input::all();
		$validation 	= Validator::make($inputs, ['parcour_id'=>'required']);

		$path 			= Session::get('language');
		if($validation->fails()) {
			return Redirect::back()->withInput()->withErrors($validation);

		}
		else {
			foreach (
				$inputs['parcour_id'] as $parcour) {
				$troncs = new Tronc();
				$troncs->element_id    = $element;
				$troncs->parcour_id    = $parcour;
				$troncs->save();
			}
			return Redirect::back()->with('success', ('Ajouté avec succès!'));
		}

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function remove_ec($id)
	{
		
		$ec = EC::find($id);

		if ($ec !== null) {

			$ec->delete();

			$path = Session::get('language');
			return Redirect::back()->with('success', ('EC a été supprimé avec succès!'));
		} 

		else {
			return Redirect::back();
		}
	}

}
