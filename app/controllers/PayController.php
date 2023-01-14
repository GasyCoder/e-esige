<?php 


class PayController extends BaseController
{
	
	protected $rules_ecolage = [	
			'motif'		=>'required', 
			'status'	=>'required'
	];

	public function index()
	{
		$title 		= 'Liste des motifs';
		$motifs 	= Motif::orderBy('id', 'asc')->get();

		return View::make('student.payments.index', compact('motifs'))->with('title', $title);
	}

	public function typepay($id)
	{	$motif      = Motif::find($id);
		$title 		= 'Moyen de paiement';
		$types 		= Typepay::where('status', 1)->get();
		return View::make('student.payments.typepay', compact('types', 'motif'))->with('title', $title);
	}

	public function addStudpay($motif, $token)
	{
		$title 			= 'Faire un paiement';
		$motif  		= Motif::find($motif);
		$type  			= Typepay::where('token', $token)->first();
		$student 		= Student::where('token', Auth::user()->token)->first();
		$verify         = Paycontrol::where('token', Auth::user()->token)->first();

		return View::make('student.payments.addpay', compact('motif', 'type', 'student', 'verify'))->with('title', $title);
	}

	public function listes_stud()
	{
		$title 			= 'Liste des paiements';
		$token          = Auth::user()->token;
		$student 		= Student::where('token',  $token)->first();
		$payments  		= Pay::where('id_student', $student->id)->get();
		
		return View::make('student.payments.pay_liste', compact('payments', 'student'))->with('title', $title);
	}

	public function infopay_stud($token)
	{
		$title 			= 'Details de paiement';
		$detail  		= Pay::where('token', $token)->first();
		
		return View::make('student.payments.detail_pay', compact('detail'))->with('title', $title);
	}

	public function payStore($token, $id) {

	$verify 	= Paycontrol::where('token', $id)->first();
    $student    = Student::where('token', $id)->first();
    $year       = Year::where('status', 1)->first();
    $type       = Typepay::where('token', $token)->first();
	if ($verify !== null) {
			
			$inputs = Input::all();

			if ($verify->mois_reste < e(Input::get('nbremois'))) {

				return Redirect::back()->withError('Désolé! le mois doit être inférieur ou égale 10!');
			}

			$validation = Validator::make($inputs, $this->rules_ecolage);
			if ($validation->fails()) {
				return Redirect::back()->withInput()->withErrors($validation);

			} else {

			if (Input::hasFile('file')) {	
				$token          = str_random(40);
				$date 			= date('d-M-Y');
				$files 			= Input::file('file');

				$destinationPath = 'uploads/files_pay/'.$date.'/';
                $filename = $files->getClientOriginalName();
                $filename = strtolower($filename);
                $filename = str_ireplace(' ', '_', $filename);
                $filename = round(microtime(true)).'_'. $filename;
                $upload_success = $files->move($destinationPath, $filename);

				$pay 			= Pay::create([
					'id_student' 	=> $student->id,
					'yearsUniv' 	=> $year->yearsUniv,
					'motif' 		=> ($inputs['motif']),
					'type' 			=> ($inputs['type']),
					'montant' 		=> ($inputs['montant']),
					'date'     		=> ($inputs['date']),
					'status' 		=>  0,
					'token' 		=> $token,
					'msg' 			=> ($inputs['msg']),
					'payment_index' => ($inputs['payment_index']),
					'agence'     	=> ($inputs['agence']),
					'nbremois'     	=> ($inputs['nbremois']),
					'file'     		=> $date . '/' .$filename,
				]);
			  } 
			else {
			$pay 				= Pay::create([
				'id_student' 	=> $student->id,
				'yearsUniv' 	=> $year->yearsUniv,
				'motif' 		=> ($inputs['motif']),
				'type' 			=> ($inputs['type']),
				'montant' 		=> ($inputs['montant']),
				'date'     		=> ($inputs['date']),
				'file'     		=> ($inputs['file']),
				'status' 		=>  0,
				'token' 		=> $token,
				'msg' 			=> ($inputs['msg']),
				'payment_index' => ($inputs['payment_index']),
				'agence'     	=> ($inputs['agence']),
				'nbremois'     	=> ($inputs['nbremois']),
			]);
			}

			$pay->save();

		 	if (Input::has('nbremois')) 
		 	{
				$verify->mois_reste   	= $verify->mois_reste-($inputs['nbremois']);
			}
		  		//$verify->status 		= 0;
		  		$verify->ecolage 	    = 1;

		  		$verify->save();
	  		return Redirect::back()->with('success', ('Paiement a été fait avec succès!'));
		}
		}
	}

    // Read Notification pay
    public function readnotifypay($id){
    	$pay               = Pay::find($id);
        $readpay           = Pay::where('token', $pay->token)->first();
        $pay->read     = 1;
        $pay->save();
        return Redirect::route('infopay_stud', $pay->token)->with('success', ($pay->msg));
    }

}