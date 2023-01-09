<?php

class SecretaireController extends BaseController
{
	protected $layouts = 'layouts.master';

	protected $secretaireRules = [	

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
		$title = 'Liste des sécretaires';
		$secretaires = Secretaire::all();

		return View::make('admin.secretaires.index', compact('secretaires'))->with('title', $title);
	}

	public function addsecretaire() {
		
		$title = 'Ajouter Sécretaire';
		return View::make('admin.secretaires.addsecretaire')->with('title', $title);

		}
	
	public function secretaireStore()
	{
			$user_id = Auth::user()->id;
			$inputs  = Input::all();

			$validation     = Validator::make($inputs, $this->secretaireRules);
			if ($validation->fails()) {
				return Redirect::back()->withInput()->withErrors($validation);
			} 
			else {
				$token   = str_random(40);

				$secretaire 		= Secretaire::create([
					
					'fname' 		=> ($inputs['fname']),
					'lname' 		=> ($inputs['lname']),
					'token'   		=> $token,
					'status'        => 1
				]);

				$user  			= User::create ([
					
                    'is_secretaire' 	=> 1,
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

			    $secretaire->save();
                $user->save();
                $profile->save();
                return Redirect::route('secretaire_admin')->with('success', 'Secretaire '.$inputs['fname'].' ajouté avec succès!'); 
			}
	}


	public function profileSecretaire($token)
	{
		$title 		= 'Profil secretaire';
		$profile 	= Secretaire::where('token', 	$token)->first();
		$user       = Profil::where('token',    	$token)->first();
        $auth 	    = User::where('token',    		$token)->first();

		return View::make('admin.secretaires.profile', compact('profile','user', 'auth'))->with('title', $title);
	}

	public function editSecretaire($token){

    	$title = 'Modifier';
    	$secretaire 	= Secretaire::where('token', $token)->first();
    	$user   		= Profil::where('token', $token)->first();
    	return View::make('admin.secretaires.update', compact('secretaire', 'user'))->with('title', $title);
    }

    public function updateSecretaire($token){

    	$inputs 		= Input::all();
    	$secretaire 	= Secretaire::where('token', $token)->first();
    	$user   		= Profil::where('token', $token)->first();
    	$user_id 		= Auth::user()->id;

    	if($secretaire !== Null) {
    		$validation = Validator::make($inputs, $this->updateRules);
			if ($validation->fails()) {
				return Redirect::back()->withInput()->withErrors($validation);
			} 
			else {
				$secretaire->fname = ($inputs['fname']);
				$secretaire->lname = ($inputs['lname']);
				//other heritage secretaire class
				$user->phone = ($inputs['phone']);
				$user->email = ($inputs['email']);
				$user->sexe = ($inputs['sexe']);

				$secretaire->save();
				$user->save();
				return Redirect::route('profileSecretaire', $secretaire->token)->withSuccess(('Secretaire '.$inputs['fname'].' a été modifié avec succès!'));
			}
    	}
    	else {
			  $path = Session::get('language');
			  return Redirect::back()->withError(Lang::get($path.'error_please_try_again'));
		}
    }

	 public function up_secretaireAuth($token) {
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
