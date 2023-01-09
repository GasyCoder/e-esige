<?php

class UEController extends BaseController {

	protected function makeSlug($string = null, $separator = "-") {
	    if (is_null($string)) {
	        return "";
	    }
	    $string = trim($string);
	    $string = mb_strtolower($string, "UTF-8");;
	    $string = preg_replace("/[\s-]+/", " ", $string);
	    $string = preg_replace("/[\s_]/", $separator, $string);

	    return $string;
	}

	public function index()
	{
		$title          = 'Unités d\'enseignement';
		$sous           = 'Listes des niveaux';
		$years   		= Year::all();
		$semestres   	= Semestre::all();
		$classes  	 	= TheClass::where('status', 1)->get();
		$parcours  		= Parcour::where('status', 1)->orderBy('id', 'asc')->paginate(10);//->where('class_id', '!=', $ue->class_id)->take(10)
		$elements 		= EC::all();
		$ues 		 	= UE::orderBy('id', 'asc')->paginate(100);

		if ($ues !== null) {
		return View::make('admin.pedagogie.UE.index', compact('ues', 'classes', 'years', 'elements', 'parcours', 'semestres'))->with('title', $title)->with('sous', $sous);
		} 

		else {
			return View::make('404');
		}
	}

	public function UEtroncCommun($class)
	{
		$title 				 = 'UE tronc commun';
		$sous           	 = 'UE tronc commun';
		$allClasses   		 = TheClass::where('id', '>=', 2)->where('status', 1)->orderBy('id', 'asc')->get();
		$class   			 = TheClass::find($class);
		$allParcours 		 = Parcour::where('status', 1)->where('class_id', $class->id)->orderBy('id', 'asc')->get();
		$semestres   		 = Semestre::where('status', 1)->get();

		return View::make('admin.pedagogie.UE.addUEtronc', compact('class','allParcours', 'allClasses', 'semestres'))->with('title', $title)->with('sous', $sous);
	}


	public function saveUETronc($class)
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

				$tronc = new UE();
				
				$tronc->user_id 		= $user_id;
				$tronc->class_id    	= $class->id;
				$tronc->parcour_id    	= $parcour;
				$tronc->name 			= $inputs['name'];
				$tronc->slug 			= $this->makeSlug($inputs['name']);
				$tronc->credit 		    = $inputs['credit'];

				$tronc->codeSem 	    = $inputs['codeSem'];

				$tronc->codeUe 			= $inputs['codeUe'];
				$tronc->tronc 			= 1;
				$tronc->choix			= 1;
				$tronc->save();

			 }
				return 'true';
			}

        }
	}

	public function storeUe($class, $parcour)
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
				
				$ues = new UE();
				$ues->user_id 		= $user_id;
				$ues->class_id    	= $class->id;
				$ues->parcour_id    = $parcour->id;
				$ues->al_value      = $parcour->id;

				$ues->codeUe 		= $inputs['codeUe'];
				$ues->name 			= $inputs['name'];
				$ues->slug 			= $this->makeSlug($inputs['name']);
				$ues->credit 		= $inputs['credit'];
				$ues->status 		= 1;

				$ues->choix 	    = $inputs['choix'];
				$ues->codeSem 	    = $inputs['codeSem'];

				$ues->save();

				return 'true';
			}

        }
	}

	public function ue_parcour($class)
	{
		$title 			 = 'Unité d\'enseignement';
		$sous            = 'Liste des parcours';
		$class   		 = TheClass::find($class);
		$semestres   	 = Semestre::all();
		$parcours 		 = Parcour::where('class_id', $class->id)
									->where('status', 1)
									->get();

		return View::make('admin.pedagogie.UE.parcours', compact('parcours', 'semestres', 'class'))->with('title', $title)->with('sous', $sous);
	}


	public function editue($class, $parcour, $ue)
	{	
		$title          = 'Modifier';
		$sous           = 'Unité d\'enseignement';
		$years   		= Year::all();
		$class   		= TheClass::all();
		$parcour 		= Parcour::all();
		$semestres   	= Semestre::all();
		$ue 			= base64_decode(str_pad(strtr($ue, '-_', '+/'), strlen($ue) % 4, '=', STR_PAD_RIGHT));
		$ues 			= UE::find($ue);

		return View::make('admin.pedagogie.UE.updateUe', compact('ues', 'class','parcour', 'semestres', 'years'))->with('title', $title)->with('sous', $sous);
	}


	public function updateUe($id)
	{
		if (Request::ajax()){
			$inputs = Input::all();
			$validation = Validator::make($inputs, ['name'=>'required']);
			if ($validation->fails()) {
				return 'false';
			} 
			else {
				$ues 				= UE::find($id);
				$ues->codeUe 		= e($inputs['codeUe']);
				$ues->name 			= e($inputs['name']);
				$ues->credit 		= e($inputs['credit']);
				$ues->tronc 		= e($inputs['tronc']);
				$ues->choix 		= e($inputs['choix']);
				$ues->codeSem 		= e($inputs['codeSem']);
				
			}

			if (Input::has('status'))
			   {
			        $ues->status = 1;

			   }else {
			        $ues->status = 0;
			  }
			$ues->save();
			return 'true'; 
        }
	} 

	public function show($class, $parcour)
	{	
		$title          = 'Detail';
		$sous           = 'Unité d\'enseignement';
		$class   		= TheClass::find($class);
		$parcour 		= Parcour::find($parcour);
		$parcours 		= Parcour::where('class_id', $class->id)->where('id', '!=', $parcour->id)->get();
		$semestres		= Semestre::all();
		//$sem		    = UE::where('codeSem', '=', 'S2')->first();
		
		$ues 		    = UE::where('class_id', $class->id)
							->where('parcour_id', $parcour->id)
							->where('codeSem', 1)
							->where('status', 1)
							->groupBy('name')
          					->orderBy('id', 'asc')
							->get();

		$ues2 		    = UE::where('class_id', $class->id)
							->where('parcour_id', $parcour->id)
							->where('codeSem', 2)
							->where('status', 1)
							->groupBy('name')
          					->orderBy('id', 'asc')
							->get();

		$ueAp 		    = UE::where('class_id', $class->id)
							->where('al_value', 1)
							->where('status', 1)
          					->orderBy('id', 'asc')
							//->orderBy('tronc')
          					->get();

												
		if ($ues !== null) {
			return View::make('admin.pedagogie.UE.show', compact('ues', 'ues2', 'semestres', 'class', 'parcour', 'parcours', 'sem', 'ueAp'))->with('title', $title)->with('sous', $sous);
		} 
		else {
			return View::make('404');
		}
	}


	public function print_ue($class, $parcour)
	{
		$title 	  = 'Mode impression';
		$sous     = 'Liste des UE';
		$class    = TheClass::find($class);
		$parcour  = Parcour::find($parcour);

		$ue_print_1 = UE::where('class_id', $class->id)
										->where('parcour_id', $parcour->id)
										->where('codeSem', 1)
		                                ->where('status', 1)
		                                ->groupBy('name')
		                                ->orderBy('id', 'asc')
		                                ->get();

        $credit_one = UE::where('class_id', $class->id)
       									->where('parcour_id', $parcour->id)
										->where('codeSem', 1)
										//->where('id', 6)
		                                //->groupBy('credit')
		                                ->orderBy('id', 'asc')
       									->sum('credit');
       	
       	//Semestre 2----
       	$ue_print_2 = UE::where('class_id', $class->id)
										->where('parcour_id', $parcour->id)
										->where('codeSem', 2)
		                                ->where('status', 1)
          								->orderBy('id', 'asc')
          								->get();

        $sumCredit_2 = DB::table('ues')->where('class_id', $class->id)
       									->where('parcour_id', $parcour->id)
										->where('codeSem', 2)
		                                ->where('status', 1)
		                                ->orderBy('tronc')
       									->sum('credit');     

		return View::make('admin.pedagogie.UE.print', compact('class', 'parcour', 'ue_print_1', 'credit_one', 'ue_print_2', 'sumCredit_2'))->with('title', $title)->with('sous', $sous);
	}

	public function deleteUe($id)
	{
		$ue = UE::find($id);

		if ($ue !== null) {

			$ue->delete();

			return Redirect::back()->with('success', ('Unité d\'enseignement a été supprimé avec succès!'));
		} 

		else {
			return Redirect::back();
		}
	}





}
