<?php 
class AdminController extends BaseController {

    protected $typeRules = [  
        
            'title'        =>'required',
            'number'       =>'required',
            'name'         =>'required'
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




}