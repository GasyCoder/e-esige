<?php 
class AdminController extends BaseController {

    protected $typeRules = [  
        
            'title'        =>'required',
            'number'       =>'required',
            'name'         =>'required'
    ];

    protected $rules_ecolage = [    
            'motif'     =>'required', 
            'status'    =>'required',
            'montant'   =>'required'
    ];

    public function index() {
        
        $title              = 'Tableau de bord';
        $year               = Year::orderBy('status', 1)->first();
        $students           = Student::count();
        
        return View::make('components.panel', compact('students', 'year'))->with('title', $title);
    }

    public function type()
    {
        $title = 'Type de paiement';
        $types = Typepay::all();

        return View::make('admin.pay.type', compact('types'))->with('title', $title);
    }

    public function addtype()
    {
        $title = 'Ajouter type de paiement';
        return View::make('admin.pay.addtype')->with('title', $title);
    }


    // Store type
    public function storetype()
    {
            $inputs         = Input::all();
            $validation     = Validator::make($inputs, $this->typeRules);
            if ($validation->fails()) {
                return Redirect::back()->withInput()->withErrors($validation);
            } 
            else {

            if (Input::hasFile('icon')) {
                
                $token   = str_random(40);
                $icons = Input::file('icon');

                $destinationPath = 'uploads/icons/';
                $filename = $icons->getClientOriginalName();
                $filename = strtolower($filename);
                $filename = str_ireplace(' ', '_', $filename);
                $filename = round(microtime(true)).'_'. $filename;
                $upload_success = $icons->move($destinationPath, $filename);
                
                $type    = Typepay::create([
                    
                'title'    => ($inputs['title']),
                'number'   => ($inputs['number']),
                'name'     => ($inputs['name']),    
                'icon'     => $filename,
                'token'    => $token
                ]);
            } 
            else {  
                $type    = Typepay::create([
                    'title'                 => ($inputs['title']),
                    'number'                => ($inputs['number']),
                    'name'                  => ($inputs['name']),
                    'token'                 => $token
                ]);   
            }
            $type->save();
            return Redirect::route('typeControle')->withSuccess('Type de paiement a été ajouté avec succès!'); 
        }    
    }


    // Update type
    public function update_type($id)
    {
        $inputs         = Input::all();
        $type           = Typepay::findOrFail($id);
        $validation     = Validator::make($inputs, $this->typeRules);
        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation);
        } 
        else {
            if (Input::hasFile('icon')) {
                // delete old image
                if (!empty($type->icon)) {
                    //unlink(public_path("uploads/icons/".$type->icon));
                    unlink(public_path()."/uploads/icons/".$type->icon);
                }
                $icons = Input::file('icon');
                $destinationPath = 'uploads/icons/';
                $filename = $icons->getClientOriginalName();
                $filename = strtolower($filename);
                $filename = str_ireplace(' ', '_', $filename);
                $filename = round(microtime(true)).'_'. $filename;
                $upload_success = $icons->move($destinationPath, $filename);

                $type->title    = ($inputs['title']);
                $type->number   = ($inputs['number']);
                $type->name     = ($inputs['name']);    
                $type->icon     = $filename;
            } 

            else {  
                $type->title    = ($inputs['title']);
                $type->number   = ($inputs['number']);
                $type->name     = ($inputs['name']);    
            }

            if (Input::has('status'))
               {
                $type->status = 1;
               }
            else {
               $type->status = 0;
            }

            $type->save();
            return Redirect::route('typeControle')->withSuccess('Type de paiement a été modifié avec succès!'); 
        }
    }


    // Check Payment
    public function checkpay(){

        $title = 'Vérification de paiement';
        $checks = Pay::where('status', 0)->orderBy('id', 'desc')->get();
        return View::make('admin.pay.check', compact('checks'))->with('title', $title);
    }

    public function viewDetail_pay($id){

        $title  = 'Detail de paiement';
        $detail = Pay::find($id);
        return View::make('admin.pay.detail', compact('detail'))->with('title', $title);
    }

    public function validPay($id){

        $validpay           = Pay::find($id);
        $validpay->status   = 1;
        $validpay->save();
        return Redirect::route('chekpay')->with('success', ('Paiement a été activé!'));
    }

    public function addPay($id){
        $title  = 'Ajouter paiement';
        $addpay = Student::find($id);
        $verify = Paycontrol::find($id);
        return View::make('admin.pay.addPay', compact('addpay', 'verify'))->with('title', $title);
    }

    public function addPay_byscol($id)
    {
        $inputs         = Input::all();
        $id_stud        = Student::find($id);
        $verify         = Paycontrol::find($id);
        $user           = Auth::user()->id;
        $validation     = Validator::make($inputs, [
            'motif' => 'required',
            'montant' => 'required|numeric',
            'msg' => 'required',
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
            'payment_index' => $payment_index,
            'token'         => $token,
            'date'          => ($inputs['date']),
            'status'        => 1
            ]);   
            $add->save();

            $verify->otherpay  = 1;
            $verify->save();

            return Redirect::back()->withSuccess('Paiement a été ajouté avec succès!'); 
    } 

}


    //Other pay for admin to students

    public function pay_stud_Class()
    {
        $title           = 'Choisir niveau';
        $years           = Year::where('status', 1)->get();
        $classes         = TheClass::all();
        return View::make('admin.pay.other.niveau', compact('classes', 'years'))->with('title', $title);
    }
    
    public function pay_stud_Parcour($class)
    {
        $title           = 'Choisir Parcours';
        $class           = TheClass::find($class);
        $years           = Year::where('status', 1)->get();
        $parcours        = Parcour::where('class_id', $class->id)
                                    ->where('status', 1)
                                    ->get();
        return View::make('admin.pay.other.parcours', compact('parcours', 'class', 'years'))->with('title', $title);
    }

    public function pay_by_Studliste($class, $parcour)
    {
        $title           = 'Ajouter paiement';
        $class           = TheClass::find($class);
        $parcour         = Parcour::find($parcour);
        $years           = Year::where('status', 1)->first();

        $students        = Student::where('class_id',      $class->id)
                                     ->where('parcour_id', $parcour->id)
                                     ->where('yearsUniv',  $years->yearsUniv)
                                     ->get();

        return View::make('admin.pay.other.students_listes', compact('parcour', 'class', 'years', 'students'))->with('title', $title);
    }

}