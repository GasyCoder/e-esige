<?php 


class PayController extends BaseController
{
	
	protected $rules_ecolage = [	
			'motif'		=>'required',
			//'montant'	=>'required',  
			'status'	=>'required'

	];

	public function index()
	{
		$title 		= 'Page de paiement';
		$payments 	= DB::table('payments')->orderBy('id', 'asc')->get();

		return View::make('student.payments.index', compact('payments'))->with('title', $title);
	}

	public function typepay()
	{
		$title 		= 'Types de paiement';
		$types 		= Typepay::all();
		return View::make('student.payments.typepay', compact('types'))->with('title', $title);
	}

	public function addStudpay($token)
	{
		$title 	= 'Faire un paiement';
		$motifs = Motif::orderBy('id', 'asc')->get();
		$type  	= Typepay::where('token', $token)->first();
		$i 		= Student::where('token', Auth::user()->token)->first();

		return View::make('student.payments.addpay', compact('motifs', 'type', 'i'))->with('title', $title);
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

				//$token   = str_random(40);
			if ($type->same == 1) {

				$pay 			= Pay::create([

					'id_student' 	=> $student->id,
					'yearsUniv' 	=> $year->yearsUniv,
					'motif' 		=> ($inputs['motif']),
					'type' 			=> ($inputs['type']),
					'montant' 		=> ($inputs['montant']),
					'date'     		=> ($inputs['date']),
					'file'     		=> ($inputs['file']),
					'status' 		=>  1,
					'token' 		=> $id,
					'payment_index' => ($inputs['payment_index']),
					'nbremois'     	=> ($inputs['nbremois']),
				]);
				} 
				else {
					$pay 			= Pay::create([

					'id_student' 	=> $student->id,
					'yearsUniv' 	=> $year->yearsUniv,
					'motif' 		=> ($inputs['motif']),
					'type' 			=> ($inputs['type']),
					'montant' 		=> ($inputs['montant']),
					'date'     		=> ($inputs['date']),
					'file'     		=> ($inputs['file']),
					'status' 		=>  1,
					'token' 		=> $id,

					'num_bordero'   => ($inputs['num_bordero']),
					'agence'     	=> ($inputs['agence']),
					'nbremois'     	=> ($inputs['nbremois']),
				]);
			}
				$pay->save();

			 	if (Input::has('nbremois')) {
					$verify->mois_reste   		= $verify->mois_reste - ($inputs['nbremois']);
				}
			 	
				$verify->class_id 			= $student->class_id;
				$verify->parcour_id 		= $student->parcour_id;

			  	$verify->otherpayed 	  	= 1;
			  	$verify->status 			= 1;
			  	$verify->payed 	      		= 1;

			  	$verify->save();

		  return Redirect::back()->with('success', ('Paiement a été fait avec succès!'));
		}
	}
}

}