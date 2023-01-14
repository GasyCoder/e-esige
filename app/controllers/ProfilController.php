<?php 
use Intervention\Image\ImageManagerStatic as Image;
class ProfilController extends BaseController
{
	protected $updateRules = [	
		
			'fname'			=>'required',
			'phone'		    =>'required',
	];

	public function index()
	{
		$title = 'Panel étudiant';
		$student = Student::where('status', 1)->count();
		return View::make('components.panel', compact('student'))->with('title', $title);
	}

	public function profile($token)
	{
		$title = 'Mon profil';
		$profile  = Student::where('token', $token)->first();
		$user     = Profil::where('token', $token)->first();
	if($user !== Null){
		return View::make('student.profile', compact('profile', 'user'))->with('title', $title);
	}else{
		return Redirect::back();
	}

	}

   public function update($token){

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

			$user->phone = ($inputs['phone']);
			$user->fb = ($inputs['fb']);

			$student->save();
			$user->save();
			return Redirect::back()->withSuccess('Votre profil a été mis à jour!');
		}
	}
	else {
			$path = Session::get('language');
			return Redirect::back()->withError(Lang::get($path.'error_please_try_again'));
		}
	}

	/*public function photoStudent($token) {

    $user = Profil::where('token', $token)->first();
    $inputs = Input::all();
    $validation = Validator::make($inputs, ['photo'=>'required|image']); 

    if ($validation->fails()) {
        return Redirect::back()->withInput()->withErrors($validation);
    } else {
        if (Input::hasFile('photo')) {

            // delete old image
            if (!empty($user->photo)) {
                unlink(public_path()."/uploads/profiles/students/".$user->photo);
            }

            $image = Input::file('photo');
            $destinationPath = 'uploads/profiles/students/';

            $filename = $image->getClientOriginalName();
            $filename = strtolower($filename);
            $filename = str_ireplace(' ', '_', $filename);
            $filename = round(microtime(true)).'_'. $filename;

            $upload_success = $image->move($destinationPath, $filename);

            $user->photo = $filename;
            $user->save();
            return Redirect::back()->withSuccess('Photo de profil a été changé avec succès!');
          }   
    	}
	}*/

	public function photoStudent($token) {
	    
    	$inputs = Input::all();
	    //validate the image
	    $validation = Validator::make($inputs, ['photo'=>'required|image']); 
	    //get image file
	   if ($validation->fails()) {
        return Redirect::back()->withInput()->withErrors($validation);
    	} 
      else {
	    //$image = $inputs->file('photo');
	    $image = Input::file('photo');
	    //create a file name
	    $fileName = time().'.'.$image->getClientOriginalExtension();
	    //$fileName = $image->getClientOriginalName();

	    //path to store the image
	    $path = public_path('/uploads/profiles/students/');

	    //resize and save image
	    $profileImage = Image::make($image->getRealPath());
	    $profileImage->resize(300, 300);
	    $profileImage->save($path . $fileName);

	    //create a cover image
	    $coverImage = Image::make($image->getRealPath());
	    $coverImage->fit(800, 300);
	    $coverImage->save($path . 'cover_' . $fileName);

	    //save image name to user
	    $user = Profil::where('token', $token)->first();
	    $user->photo = $fileName;
	    $user->cover_picture = 'cover_'.$fileName;
	    $user->save();

	    return Redirect::back()->withSuccess('Photo de profil a été changé avec succès!');
	}
}

	public function delete_photo($token)
	{
		$filepdp = Profil::where('token', $token)->first();
		if ($filepdp !== null) {
			$filepdp->photo = NULL;
			$filepdp->save();
			return Redirect::back()->with('success', ('Photo de profil a été supprimé!'));
		}
		else {
			return Redirect::back()->with('error', ('Une erreur est survenu!'));
		}
	}

	public function student_update_password($token)
	{
		$user 	 = User::where('token', $token)->first();
		$input   = Input::all();
		$validation = Validator::make($input, ['old_password'=>'required', 'password'=>'required|min:6', 'password_confirm'=>'required|same:password']);
		if ($validation->fails()) {
			return Redirect::back()->withErrors($validation);
		} else {
			$old_password = Input::get('old_password');
			if (Hash::check($old_password, $user->password)) {
				$user->password = Hash::make($input['password']);
				$user->save();
				$path = Session::get('language');
				return Redirect::back()->withSuccess(Lang::get($path.'.Information_modified'));
			}
			else {
				$path = Session::get('language');
				return Redirect::back()->withError(Lang::get($path.'.password_error'));
			}
		}
	}



}