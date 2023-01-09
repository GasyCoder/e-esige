<?php

class TeacherController extends BaseController
{
	protected $layouts = 'layouts.master';

	protected $teacherRules = [	

			'fname'			=> 'required',
			'phone'		    => 'required',
			'sexe'  		=> 'required',
			'email'         => 'required|unique:users',
			'password'		=> 'required|min:6',
			'password_confirm'=>'required|same:password'
	];

	protected $updateRules = [	

			'fname'			=>'required',
			'phone'		    =>'required',
			'sexe'  		=>'required',
	];

	public function index()
	{
		$title = 'Liste des enseignants';
		$teachers = Teacher::all();

		return View::make('admin.teachers.index', compact('teachers'))->with('title', $title);
	}

	public function addteacher() {
		
		$title = 'Ajouter enseignant';
		return View::make('admin.teachers.addteacher')->with('title', $title);

		}
	
	public function teacherStore()
	{
			$user_id = Auth::user()->id;
			$inputs  = Input::all();

			$validation     = Validator::make($inputs, $this->teacherRules);
			if ($validation->fails()) {
				return Redirect::back()->withInput()->withErrors($validation);
			} 
			else {
				$token   = str_random(40);

				$teacher 		= Teacher::create([
					
					'fname' 		=> ($inputs['fname']),
					'lname' 		=> ($inputs['lname']),
					'user_id'       => $user_id,
					'token'   		=> $token,
					'status'        => 1
				]);

				$user  			= User::create ([
					
                    'is_teacher' 		=> 1,
                    'email' 	        => ($inputs['email']),
                    'password' 		    => Hash::make(e($inputs['password'])),
                    'token'   			=> $token
			    ]);

			    $profile 		= Profil::create ([

                    'sexe' 	            => ($inputs['sexe']),
                    'phone' 	        => ($inputs['phone']),
                    'email' 	        => ($inputs['email']),
                    'token'             => $token
			    ]);

			    $teacher->save();
                $user->save();
                $profile->save();
                return Redirect::route('teacher_admin')->with('success', 'Enseignant '.$inputs['fname'].' ajouté avec succès!'); 
			}
	}


	public function profileTeacher($token)
	{
		$title 		= 'Profil enseignant';
		$profile 	= Teacher::where('token', 	$token)->first();
		$user       = Profil::where('token',    $token)->first();
        $auth 	    = User::where('token',    	$token)->first();

		return View::make('admin.teachers.profile', compact('profile','user', 'auth'))->with('title', $title);
	}

	public function editTeacher($token){

    	$title = 'Modifier';
    	$teacher 	= Teacher::where('token', $token)->first();
    	$user   	= Profil::where('token', $token)->first();
    	return View::make('admin.teachers.update', compact('teacher', 'user'))->with('title', $title);
    }

    public function updateTeacher($token){

    	$inputs 	= Input::all();
    	$teacher 	= Teacher::where('token', $token)->first();
    	$user   	= Profil::where('token', $token)->first();
    	$user_id 	= Auth::user()->id;

    	if($teacher !== Null) {
    		$validation = Validator::make($inputs, $this->updateRules);
			if ($validation->fails()) {
				return Redirect::back()->withInput()->withErrors($validation);
			} 
			else {
				$teacher->fname = ($inputs['fname']);
				$teacher->lname = ($inputs['lname']);
				//other heritage teacher class
				$user->phone = ($inputs['phone']);
				$user->email = ($inputs['email']);
				$user->sexe = ($inputs['sexe']);

				$teacher->save();
				$user->save();
				return Redirect::route('profileTeacher', $teacher->token)->withSuccess(('Enseignant '.$inputs['fname'].' a été modifié avec succès!'));
			}
    	}
    	else {
			  $path = Session::get('language');
			  return Redirect::back()->withError(Lang::get($path.'error_please_try_again'));
		}
    }

	 public function up_teacherAuth($token) {
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
