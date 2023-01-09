<?php 

class StudentController extends BaseController 
{
    
    protected $layouts = 'layouts.master';

	protected $studentRules = [	
		
			'fname'			=>'required',
			'phone'		    =>'required',
			'sexe'  		=> 'required',
			'email'         => 'required|unique:users',
            'matricule'     => 'required|unique:students',
			'password'		=>'required|min:6',
			'password_confirm'=>'required|same:password'
	];

	protected $updateRules = [	
		
			'fname'			=>'required',
			'phone'		    =>'required',
			'sexe'  		=>'required',
	];

    public function index() {

        $title  = 'Etudiants';
        $students = Student::count();
        $years   = Year::where('status', 1)->first();

        return View::make('admin.students.index', compact('students', 'years'))->with('title', $title);
    }

    public function selectNiveau()
	{
		$title 			 = 'Choisir niveau';
		$years   		 = Year::where('status', 1)->get();
		$classes 		 = TheClass::all();
		return View::make('admin.students.niveau', compact('classes', 'years'))->with('title', $title);
	}
    
    public function selectParcour($class)
	{
		$title 			 = 'Choisir Parcours';
		$class   		 = TheClass::find($class);
		$years   		 = Year::where('status', 1)->get();
		$parcours 		 = Parcour::where('class_id', $class->id)
          							->where('status', 1)
          							->get();

		return View::make('admin.students.parcours', compact('parcours', 'class', 'years'))->with('title', $title);
	}

    public function selectVague($class, $parcour)
	{
		$title 			 = 'Choisir Vague';
		$class   		 = TheClass::find($class);
        $parcour   		 = Parcour::find($parcour);
		$years   		 = Year::where('status', 1)->get();
		$vagues 		 = Vague::where('status', 1)->get();

		return View::make('admin.students.vagues', compact('vagues', 'class', 'parcour'))->with('title', $title);
	}
    

    public function inscription($class, $parcour, $vague)
	{
		$title 			 = 'Inscription';
		$class   		 = TheClass::find($class);
		$parcour 		 = Parcour::find($parcour);
		$vague 		     = Vague::find($vague);
		$years   		 = Year::where('status', 1)->first();

		/*$students 		 = Student::where('class_id',      $class->id)
									 ->where('parcour_id', $parcour->id)
									 ->where('yearsUniv',  $years->yearsUniv)
									 ->count();*/

		return View::make('admin.students.add', compact('parcour', 'class', 'years', 'students', 'vague'))->with('title', $title);
	}
    
    public function studentStore($class, $parcour, $vague)
	{
			$inputs         = Input::all();
            $class   		= TheClass::find($class);
            $parcour   		= Parcour::find($parcour);
            $vague   		= Vague::find($vague);
			$year           = Year::where('status', 1)->first();
			$user_id        = Auth::user()->id;

			$validation     = Validator::make($inputs, $this->studentRules);
			if ($validation->fails()) {
				return Redirect::back()->withInput()->withErrors($validation);
			} 
			else {

				$token   = str_random(40);

				$student    = new Student ([
					'fname' 	        => ($inputs['fname']),
                    'lname' 	        => ($inputs['lname']),
                    'matricule'         => ($inputs['matricule']),
                    'class_id' 	        => $class->id,
                    'parcour_id'        => $parcour->id,
                    'vague_id'          => $vague->id,
					'yearsUniv'         => $year->yearsUniv,
                    'user_id' 			=> $user_id,
                    'status' 			=> 1,
                    'token'             => $token
				]);

                $user 		= new User ([
                    'is_student' 		=> 1,
                    'email' 	        => ($inputs['email']),
                    'password' 		    => Hash::make(e($inputs['password'])),
                    'token'             => $token
			    ]);

                $profile 	= new Profil ([
                    'sexe' 	            => ($inputs['sexe']),
                    'phone' 	        => ($inputs['phone']),
                    'email' 	        => ($inputs['email']),
                    'token'             => $token
			    ]);

				$student->save();
                $user->save();
                $profile->save();
                return Redirect::route('profileEtudiant', $student->token)->with('success', 'Etudiant '.$inputs['fname'].' ajouté avec succès!'); 
			}
	}

    public function profileEtudiant($token)
	{
		$title 		= 'Profil étudiant';
		$profile 	= Student::where('token', 	$token)->first();
		$user       = Profil::where('token',    $token)->first();
        $auth 	    = User::where('token',    	$token)->first();

		return View::make('admin.students.showprofile', compact('profile','user', 'auth'))->with('title', $title);
	}

    public function student_liste() {

        $title = 'Liste des étudiants';
        $students = DB::table('students')->orderBy('id', 'asc')->get();
        return View::make('admin.students.listes', compact('students'))->with('title', $title);
    }

    public function editStudent($token){

    	$title = 'Modifier';
    	$student 	= Student::where('token', $token)->first();
    	$user   	= Profil::where('token', $token)->first();
    	return View::make('admin.students.update', compact('student', 'user'))->with('title', $title);
    }

    public function updateStudent($token){

    	$inputs 	= Input::all();
    	$student 	= Student::where('token', $token)->first();
    	$user   	= Profil::where('token', $token)->first();
    	$user_id 	= Auth::user()->id;

    	if($student !== Null) {

    		$validation = Validator::make($inputs, $this->updateRules);
			if ($validation->fails()) {
				return Redirect::back()->withInput()->withErrors($validation);
			} 
			else {

				$student->fname = ($inputs['fname']);
				$student->lname = ($inputs['lname']);
				$student->matricule = ($inputs['matricule']);

				//other heritage student class
				$user->phone = ($inputs['phone']);
				$user->email = ($inputs['email']);
				$user->sexe = ($inputs['sexe']);

				$student->save();
				$user->save();
				return Redirect::route('profileEtudiant', $student->token)->withSuccess(('Etudiant '.$inputs['fname'].' a été modifié avec succès!'));
			}
    	}
    	else {

    			$path = Session::get('language');
				return Redirect::back()->withError(Lang::get($path.'error_please_try_again'));
		}
   }

    public function update_std_auth($token) {
    	$inputs 	= Input::all();
    	$auth  		= User::where('token', $token)->first();
    	
    	$validation     = Validator::make($inputs, ['password'=>'required|min:6', 'password_confirm'=>'required|same:password']);
		if ($validation->fails()) {
				return Redirect::back()->withInput()->withErrors($validation);
		} 

    	if($auth   !== Null) {

    		$auth->password = Hash::make(e(Input::get('password')));

    		return Redirect::back()->withSuccess('Information de connexion a été modifié, avec succès!');
    	 }
    	 else {
    	 		$path = Session::get('language');
				return Redirect::back()->withError(Lang::get($path.'.password_error'));
			}
   	 }
	
}