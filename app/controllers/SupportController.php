<?php 
class SupportController extends BaseController
{
	protected $rules = [

			'file' => 'mimes:doc,docx,ppt,pptx,pdf,rar,zip|max:3000',
			'title'=>'required', 

	];

	protected function make_slug($string = null, $separator = "-") {
    if (is_null($string)) {
        return "";
    }
    $string = trim($string);
    $string = mb_strtolower($string, "UTF-8");;
    $string = preg_replace("/[\s-]+/", " ", $string);
    $string = preg_replace("/[\s_]/", $separator, $string);
    return $string;
	}

	public function checkClassCours()
	{
		$title 			 = 'Ajouter support';
		$years   		 = Year::where('status', 1)->get();
		$classes 		 = TheClass::all();

		return View::make('admin.supports.niveau', compact('classes', 'years'))->with('title', $title);
	}

	public function checkParcourCours($class)
	{
		$title 			 = 'Ajouter support';
		$class   		 = TheClass::find($class);
		$years   		 = Year::where('status', 1)->get();
		$parcours 		 = Parcour::where('class_id', $class->id)
          							->where('status', 1)
          							->get();

		return View::make('admin.supports.parcours', compact('parcours', 'class', 'years'))->with('title', $title);
	}

    public function checkVagueCours($class, $parcour)
	{
		$title 			 = 'Ajouter support';
		$class   		 = TheClass::find($class);
        $parcour   		 = Parcour::find($parcour);
		$years   		 = Year::where('status', 1)->get();
		$vagues 		 = Vague::where('status', 1)->get();

		return View::make('admin.supports.vagues', compact('vagues', 'class', 'parcour'))->with('title', $title);
	}
    
	public function formCours($class, $parcour, $vague)
	{
		$title 			 = 'Ajouter support';
		$class   		 = TheClass::find($class);
		$parcour 		 = Parcour::find($parcour);
		$vague 		     = Vague::find($vague);
		$matieres 		 = EC::where('class_id', $class->id)
									->where('parcour_id', $parcour->id)
									->where('status', 1)
									->get();
		$years   		 = Year::where('status', 1)->first();

		$cours           = Support::where('class_id', $class->id)
									->where('parcour_id', $parcour->id)
									->where('vague_id', $vague->id)
									->get();
		$if_Existe   	= Support::where('class_id', $class->id)
									->where('parcour_id', $parcour->id)
									->where('vague_id', $vague->id)
									->count();
												
		return View::make('admin.supports.add', compact('cours', 'class', 'parcour', 'vague', 'years', 'matieres', 'if_Existe'))->with('title', $title);
	}

	public function CoursStore($class, $parcour, $vague)
	{
			$id 		= Auth::user()->id;
			$class 		= TheClass::find($class);
			$parcour 	= Parcour::find($parcour);
			$vague 		= Vague::find($vague);
			$year       = Year::where('status', 1)->first();
			$inputs 	= Input::all();
			$validation = Validator::make($inputs, $this->rules);

			if ($validation->fails()) {
				return Redirect::back()->withInput()->withErrors($validation);
			} 

			else {

				if (Input::hasFile('file')) {

				$date 			= date('d-M-Y');
				$files 			= Input::file('file');

				$destinationPath = 'uploads/support_files/'.$date.'/';
                $filename = $files->getClientOriginalName();
                $filename = strtolower($filename);
                $filename = str_ireplace(' ', '_', $filename);
                $filename = round(microtime(true)).'_'. $filename;
                $upload_success = $files->move($destinationPath, $filename);

				$token   = str_random(40);

				$support = Support::create([

				'user_id' 			=> $id,
                'class_id' 	        => $class->id,
                'parcour_id'        => $parcour->id,
                'vague_id'          => $vague->id,

                'matiere_id'		=> ($inputs['matiere_id']),
                'volh'				=> ($inputs['volh']),
                'title'				=> ($inputs['title']),
				'slug'				=> $this->make_slug($inputs['title']),
				'content'			=> ($inputs['content']),
				'yearsUniv'			=> $year->yearsUniv,

				'status' 			=> 0,
				'token'             => $token,
				'file'     			=> $date . '/' .$filename

				]);

				$support->save();
				return Redirect::back()->withSuccess('Support du cours a été ajouté avec succès!');
				} 

				else {

					$support = Support::create([

					'user_id' 			=> $id,
                    'class_id' 	        => $class->id,
                    'parcour_id'        => $parcour->id,
                    'vague_id'          => $vague->id,

                    'matiere_id'		=> ($inputs['matiere_id']),
                    'volh'				=> ($inputs['volh']),
                    'title'				=> ($inputs['title']),
					'slug'				=> $this->make_slug($inputs['title']),
					'content'			=> ($inputs['content']),
					'yearsUniv'			=> $year->yearsUniv,

					'status' 			=> 0,
					'token'             => $token

					]);

					$support->save();
					return Redirect::back()->withSuccess('Support du cours a été ajouté!');
					//return Redirect::route('formCours', [$class->id,$parcour->id,$vague->id])->withSuccess('Cours a été partager!');
				} 
			}
	}



	// Detail and Partager Support-Cours 

	public function detail($id){
	 $title 		 = 'Detail de support';
	 $support 		 = Support::find($id);
	 $file    		 = explode(",", $support->file);

	 $students 		 = Student::where('class_id', $support->class_id)
	 							->where('parcour_id', $support->parcour_id)
	 							->where('vague_id', $support->vague_id)
	 							->get();

	 $years   		 = Year::where('status', 1)->first();

	 return View::make('admin.supports.detail', compact('students', 'years','support', 'file', 'size'))->with('title', $title);
	}


	public function share($id) {

		$inputs  = Input::all();
		$support = Support::find($id);

		$validation     = Validator::make($inputs, ['']);

			if ($validation->fails()) {
				return Redirect::back()->withInput()->withErrors($validation);
			} 
			else {

			$actif   		= $inputs['status'];
			$class   		= $inputs['class_id'];
			$parcour   		= $inputs['parcour_id'];
			$vague   		= $inputs['vague_id'];	

			foreach ($inputs['id_student'] as $i => $stud)
			{
				$share = new Lesson();	

				$share->id_student 	    	= $stud;
				$share->id_cour 	    	= $id;
				$share->id_matiere 	    	= $support->matiere_id;
                $share->status 				= $actif[$i];
                $share->token           	= $support->token;
                $share->class_id 			= $class[$i];
                $share->parcour_id 			= $parcour[$i];
                $share->vague_id 			= $vague[$i];

                $share->save();
			}

			$support->status = 1;
			$support->save();

            return Redirect::route('formCours', [$support->class_id,$support->parcour_id,$support->vague_id])->withSuccess('Cours a été partager!');	
		}
	}

	public function delete($id)
	{
		$support = Support::find($id);
		if ($support !== null) {
					// delete  file
					if (!empty($support->file)) {
						
						$one_files = explode(",", $support->file);

						foreach ($one_files as $on) {
							unlink(public_path()."/uploads/support_files/".$on);
						}
					}
					// delete lesson
					
					$lesson  = Lesson::where('id', $support->id)->delete();

					$support->delete();

					$path = Session::get('language');
					return Redirect::route('formCours', [$support->class_id,$support->parcour_id,$support->vague_id])->withSuccess('Support a été supprimé avec succès!');
		} 
		else {
				return Redirect::route('formCours', [$support->class_id,$support->parcour_id,$support->vague_id])->withErrors('Une erreur est survenu!');
			}
	}

}