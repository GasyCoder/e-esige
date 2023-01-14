<?php 

class StudentController extends BaseController 
{
    
    protected $layouts = 'layouts.master';

	protected $studentRules = [	
		
			'fname'			=>'required',
			'phone'		    =>'required',
			'sexe'  		=> 'required',
			'country' 		=> 'required',
			'city'			=> 'required',
			'email'         => 'required|unique:users',
            'matricule'     => 'required|unique:students',
			'password'		=>'required|min:6',
	];

	protected $updateRules = [	
		
			'fname'			=>'required',
			'phone'		    =>'required',
			'sexe'  		=>'required',
	];

    public function index() {

        $title  	= 'Etudiants';
        $students 	= Student::count();
        $years   	= Year::where('status', 1)->first();

        return View::make('admin.students.index', compact('students', 'years', 'stud'))->with('title', $title);
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
                    'status' 			=> 0,
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
                    'country' 	        => ($inputs['country']),
                    'city' 	        	=> ($inputs['city']),
                    'token'             => $token
			    ]);

			    $varify 	= new Paycontrol ([
                    'token'             => $token,
                    'status' 			=> 0,
			    ]);

				$student->save();
                $user->save();
                $profile->save();
                $varify->save();

                return Redirect::route('steplatest_pay', $student->id)->with('warning', 'Veuillez ajouter le paiement.'); 
			}
	}

    public function profileEtudiant($token)
	{
		$title 		= 'Profil étudiant';
		$profile 	= Student::where('token', 	$token)->first();
		$user       = Profil::where('token',    $token)->first();
        $auth 	    = User::where('token',    	$token)->first();
        $payers     = Pay::where('id_student',  $profile->id)->get();
        $year       = Year::where('status', 1)->first();
        $cours      = Lesson::where('id_student', $profile->id)->get();
    if($profile !== Null){
		return View::make('admin.students.showprofile', compact('profile','user', 'auth', 'payers', 'year', 'cours'))->with('title', $title);
	}
	else{
		return Redirect::back()->withError('Une erreur est survenu!');
	}
}

    public function student_liste() {

        $title = 'Liste des étudiants';
        $students = DB::table('students')->orderBy('id', 'desc')->get();
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
				$user->phone 	= ($inputs['phone']);
				$user->email 	= ($inputs['email']);
				$user->country 	= ($inputs['country']);
				$user->city 	= ($inputs['city']);

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
	
	/// Step to make Pyment for Student and the latest step for his enroll. 
   	public function steplatest_pay($id){
        $title  	= 'Ajouter paiement';
        $step_pay 	= Student::find($id);
        $verify 	= Paycontrol::find($id);
        return View::make('admin.students.latest_step_pay', compact('step_pay', 'verify'))->with('title', $title);
    }

    public function sotre_firstpay($id)
    {
        $inputs         = Input::all();
        $student        = Student::find($id);
        $profile        = Profil::find($id);
        $verify         = Paycontrol::find($id);
        $user           = Auth::user()->id;
        $client         = User::where('token',  $student->token)->first();
        //$reset 			= Reset::where('token', $student->token)->first();
        $validation     = Validator::make($inputs, [
            'motif' => 'required',
            'montant' => 'required|numeric',
            'msg' => 'required',
            'nbremois' => 'required|numeric',
            'date' => 'required|date'
            ]);
        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation);
        } 
        else {
            $token          = str_random(40);
            $payment_index  = rand(11111, 99999);
            $add            = Pay::create([
            'user_id'       => $user,
            'id_student'    => $id,
            'motif'         => ($inputs['motif']),
            'montant'       => ($inputs['montant']),
            'msg'           => ($inputs['msg']),
            'type'          => 'Fait par ESIGE',
            'agence'        => 'Scolarité ESIGE',
            'nbremois'      => ($inputs['nbremois']),
            'payment_index' => $payment_index,
            'token'         => $token,
            'date'          => ($inputs['date']),
            'status'        => 1
            ]);   
            $add->save();

        if (Input::has('nbremois')) 
        	
            {$verify->mois_reste = $verify->mois_reste-($inputs['nbremois']);}
            $verify->droit      = 1;
            $verify->ecolage    = 1;
            $verify->status     = 1;
            $verify->save();

            $student->status = 1;
            $student->save();

          $reset         = Reset::create([
            'email'      => $profile->email,
            'token'      => $profile->token,  
            ]);
          $reset->save();

          Mail::send('emails.welcome', compact('client', 'student'), function($message) use ($client, $student){
                $message->to($client->email, $student->fname . ' ' . $student->lname)
                        ->subject('Bienvenue sur notre plateforme!');
            });
            return Redirect::route('student_liste')->withSuccess('Etudiant '.$student->fname.' a été ajouté et payé avec succès!'); 
   		 } 
	}
}