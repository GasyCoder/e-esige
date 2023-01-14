<?php 
/*	
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(['before'=>'closed'], function(){
	// ------> home
	Route::get('/', ['as'=>'home', 'uses'=>'HomeController@showWelcome']);
});

//--> only users can access
Route::group(['before'=>'auth'], function(){

Route::get('/ajax-semestre',function () {
	$semestre 	= Input::get('codeUe');
	$semes		= UE::where('codeUe', $semestre)->first();
	$sem 		= DB::table('semestres')->where('codeSem','=', $semes->codeSem)->lists('id', 'semestre');
	return Response::json($sem);
});
Route::get('/ajax-choix',function () {

	$choix 	= Input::get('codeUe');
	$chois 	= UE::where('codeUe', $choix)->first();
	$ch 	= DB::table('choixs')->where('id', '=', $chois->choix)->lists('id', 'name');
	return Response::json($ch);
});

/*Route::get('/ajax_volh',function () {
	$matiere_id = Input::get('matiere_id');
	$add = DB::table('elements')->where('volH','>',0)->where('volH','=', $matiere_id)->where('status', 1)->lists('id', 'name');
	return Response::json($add);
});*/

});
//--------> if users in auth redirect to home
Route::group(['before'=>'user_in_auth'], function(){

		// ------> login
		Route::get('login', ['as'=>'login', 'uses'=>'UserController@login']);
		Route::post('check', ['as'=>'auth.check', 'uses'=>'UserController@check']);

		// ------> password forgot
		Route::get('password/reset', 				['as'=>'remind_users_reset', 'uses'=>'PasswordController@remind']);
		Route::post('password/reset', 				['as'=>'remind_password_request', 'uses'=>'PasswordController@request']);
		Route::get('password/reset/{token}', 		['as'=>'remind_password_reset', 'uses'=>'PasswordController@reset']);
		Route::post('password/reset/{token}', 		['as'=>'remind_password_update', 'uses'=>'PasswordController@update']);
});
		Route::get('logout', 						['as'=>'logout', 'uses'=>'UserController@logout']);

//--> only admin can access here
Route::group(['before'=>'admin'], function(){

	Route::get('admin', ['as'=>'panel.admin', 'uses'=>'AdminController@index']);

	// -------> Niveaux
	Route::get('admin/niveau/ajouter', ['as'=>'addniveau', 'uses'=>'ClassesController@index']);
	Route::post('admin/niveau/new', ['as'=>'storeniveau', 'uses'=>'ClassesController@store']);
	Route::get('admin/niveau/{id}/delete', ['as'=>'class_delete', 'uses'=>'ClassesController@destroy']);
	Route::get('admin/niveau/{id}/edit_niveau',	['as'=>'editNiveau', 'uses'=>'ClassesController@edit']);
	Route::post('admin/niveau/{id}/update', ['as'=>'class_update', 'uses'=>'ClassesController@update']);

	// -------> Parcours
	Route::get('admin/parcours', ['as'=>'indexParcour', 'uses'=>'ParcourController@index']);
	Route::post('admin/parcours/new', 	['as'=>'storeParcour', 'uses'=>'ParcourController@storeParcour']);
	Route::get('admin/parcours/{id}/delete', 	['as'=>'deleteP', 'uses'=>'ParcourController@delete']);
	Route::post('admin/parcours/{id}/update',['as'=>'updateParcour', 'uses'=>'ParcourController@updateParcour']);

	// -------> Vagues
	Route::get('admin/vague/ajouter', 	['as'=>'addvague', 'uses'=>'VagueController@index']);
	Route::post('admin/vague/new', 		['as'=>'storevague', 'uses'=>'VagueController@store']);
	Route::get('admin/vague/{id}/delete', ['as'=>'vague_delete', 'uses'=>'VagueController@destroy']);
	Route::get('admin/vague/{id}/edit_vague', ['as'=>'editVague', 'uses'=>'VagueController@edit']);
	Route::post('admin/vague/{id}/update', 	['as'=>'vague_update', 'uses'=>'VagueController@update']);


	//----- Tarifs
	Route::get('admin/tarif', ['as'=>'tarif_index', 'uses'=> 'TarifController@index']);
	Route::post('admin/storetarif', ['as'=>'storetarif', 'uses'=> 'TarifController@store']);
	Route::post('admin/updatetarif/{id}',['as'=>'updatetarif', 'uses'=> 'TarifController@update']);
	Route::get('admin/tarif/delete/{id}', ['as'=>'deletetarif', 'uses'=> 'TarifController@delete']);

		// -------> Année Universitaire
	Route::get('admin/annee_universitaire/ajouter', ['as'=>'indexYear', 'uses'=>'YearController@index']);
	Route::post('admin/annee_universitaire/new', ['as'=>'storeYear', 'uses'=>'YearController@storeYear']);
	Route::post('admin/annee_universitaire/{id}/update', ['as'=>'updateYear', 'uses'=>'YearController@updateYear']);
	Route::get('admin/annee_universitaire/{id}/delete', ['as'=>'deleteYear', 'uses'=>'YearController@delete']);

	// -------> Semestres
	Route::get('admin/semestre/ajouter', ['as'=>'indexSemestre', 'uses'=>'SemestreController@index']);
	Route::post('admin/semestre/new', ['as'=>'storeSem', 'uses'=>'SemestreController@storeSem']);
	Route::post('admin/semestre/{id}/update', ['as'=>'updateSem', 'uses'=>'SemestreController@updateSem']);
	Route::get('admin/semestre/{id}/delete', ['as'=>'deleteSem', 'uses'=>'SemestreController@delete']);

	//----- Students Gestion by Admin
	Route::get('admin/etudiant/index', ['as'=> 'student_admin', 'uses' => 'StudentController@index']);

	Route::get('admin/etudiant/choisir-etape', ['as'=>'selectNiveau', 'uses'=>'StudentController@selectNiveau']);

	Route::get('admin/etudiant/choisir-etape/{class}', ['as'=>'selectParcour', 'uses'=>'StudentController@selectParcour']);

	Route::get('admin/etudiant/choisir-etape/{class}/{parcour}', ['as'=>'selectVague', 'uses'=>'StudentController@selectVague']);

	Route::get('admin/etudiant/choisir-etape/{class}/{parcour}/{vague}', ['as'=>'inscription', 'uses'=>'StudentController@inscription']);

	Route::post('admin/etudiant/store/{class}/{parcour}/{vague}', ['as'=>'studentStore', 'uses'=>'StudentController@studentStore']);

	Route::get('admin/payment-add_student/step-latest/{id}', ['as'=>'steplatest_pay', 'uses'=>'StudentController@steplatest_pay']);

	Route::post('admin/payment-add_student/store-by-esige/{id}', ['as'=>'sotre_firstpay', 'uses'=>'StudentController@sotre_firstpay']);

	Route::get('admin/etudiant/profil/{token}', ['as'=>'profileEtudiant', 'uses'=>'StudentController@profileEtudiant']);

	Route::get('admin/etudiant/listes', ['as'=>'student_liste', 'uses' => 'StudentController@student_liste']);

	Route::get('admin/etudiant/modifier/{token}', ['as'=>'editStudent', 'uses' => 'StudentController@editStudent']);

	Route::post('admin/etudiant/update/{token}', ['as'=>'updateStudent', 'uses' => 'StudentController@updateStudent']);
	//Update Auth for student by Admin
	Route::post('admin/etudiant/update/auth/{token}',  ['as'=>'update_std_auth', 'uses' => 'StudentController@update_std_auth']);

	// Export Student 
	Route::post('admin/export/etudiant/file_csv', ['as'=>'data_export', 'uses'=>'ExportController@data_export']);

	//------> Teachers
	Route::get('admin/enseignant/index', ['as' => 'teacher_admin', 'uses'=> 'TeacherController@index']);
	Route::get('admin/enseignant/add', ['as'=>'addteacher', 'uses' => 'TeacherController@addteacher']);
	Route::post('admin/enseignant/store', ['as'=>'teacherStore', 'uses'=>'TeacherController@teacherStore']);
	Route::get('admin/enseignant/profil/{token}', ['as'=>'profileTeacher', 'uses'=>'TeacherController@profileTeacher']);
	Route::get('admin/enseignant/modifier/{token}', ['as'=>'editTeacher', 'uses' => 'TeacherController@editTeacher']);
	Route::post('admin/enseignant/update/{token}',  ['as'=>'updateTeacher', 'uses' => 'TeacherController@updateTeacher']);
	//Update Auth for teacher by Admin
	Route::post('admin/enseignant/update/auth/{token}',  ['as'=>'up_teacherAuth', 'uses' => 'TeacherController@up_teacherAuth']);

	//------> Secrétaire ESIGE
	Route::get('admin/secretaire/index', ['as' => 'secretaire_admin', 'uses'=> 'SecretaireController@index']);
	Route::get('admin/secretaire/add', ['as'=>'addsecretaire', 'uses' => 'SecretaireController@addsecretaire']);
	Route::post('admin/secretaire/store', ['as'=>'secretaireStore', 'uses'=>'SecretaireController@secretaireStore']);
	Route::get('admin/secretaire/profil/{token}', ['as'=>'profileSecretaire', 'uses'=>'SecretaireController@profileSecretaire']);
	Route::get('admin/secretaire/modifier/{token}', ['as'=>'editSecretaire', 'uses' => 'SecretaireController@editSecretaire']);
	Route::post('admin/secretaire/update/{token}',  ['as'=>'updateSecretaire', 'uses' => 'SecretaireController@updateSecretaire']);
	//Update Auth for teacher by Admin
	Route::post('admin/secretaire/update/auth/{token}',  ['as'=>'up_secretaireAuth', 'uses' => 'SecretaireController@up_secretaireAuth']);

	// -------> UE
	Route::get('admin/ues_ap-{class}/{parcour}', ['as'=>'showAp', 'uses'=>'UEController@showAp']);
	Route::get('admin/ues-{class}/{parcour}', 	['as'=>'detailsUe', 'uses'=>'UEController@show']);
	Route::get('admin/ue/unite_enseignements', 	['as'=>'indexUe', 'uses'=>'UEController@index']);
	Route::get('admin/ue/unite_enseignements/{class}', ['uses'=>'UEController@ue_parcour']);
	Route::get('admin/ue-tronc/ajouter-ue/{class}', ['as'=>'UEtroncCommun', 'uses'=>'UEController@UEtroncCommun']);
	Route::post('admin/ue-tronc/addTronc-ue/{class}', ['as'=>'saveUETronc', 'uses'=>'UEController@saveUETronc']);
	Route::post('admin/ue/new/{class}-{parcour}', ['as'=>'storeUe', 'uses'=>'UEController@storeUe']);
	Route::get('admin/ue/{class}/{parcour}', ['as'=>'detailsUe', 'uses'=>'UEController@show']);
	Route::get('admin/ue/impression/{class}/{parcour}', ['as'=>'print_ue', 'uses'=>'UEController@print_ue']);
	Route::get('admin/ue/{class}/{parcour}/{ue}/edit', 	['as'=>'editue', 'uses'=>'UEController@editue']);
	Route::post('admin/ue/{id}/update', ['as'=>'updateUe', 'uses'=>'UEController@updateUe']);
	Route::get('admin/unite_enseignement/{id}/supprimer', ['as'=>'deleteUe', 'uses'=>'UEController@deleteUe']);
	
	// -------> Gestion Matières
	Route::get('admin/element_constitutifs', ['as'=>'indexEc', 'uses'=>'EcController@index']);
	Route::get('admin/element_constitutifs/{class}', ['uses'=>'EcController@ec_parcour']);
	Route::get('admin/ec-tronc/ajouter-matiere/{class}', ['as'=>'AddtroncCommun', 'uses'=>'EcController@AddtroncCommun']);
	Route::post('admin/ec-tronc/addTronc/{class}', ['as'=>'saveTronc', 'uses'=>'EcController@saveTronc']);
	Route::post('admin/element_constitutif/new/{class}-{parcour}', ['as'=>'storeEc', 'uses'=>'EcController@storeEc']);
	Route::get('admin/element_constitutif/{id}/delete', ['as'=>'remove_ec', 'uses'=>'EcController@remove_ec']);
	Route::get('admin/element_constitutif/{class}/{parcour}', ['as'=>'addnew', 'uses'=>'EcController@addnew']);
	Route::get('admin/element_constitutif/modifier/{class}/{parcour}/{element}', ['as'=>'edit_ec', 'uses'=>'EcController@edit']);
	Route::post('admin/element_constitutif/{id}/update', ['as'=>'updateEc', 'uses'=>'EcController@updateEc']);
	Route::post('admin/element_constitutif/{id}/ajouter-teacher', ['as'=>'ajouterTeacher', 'uses'=>'EcController@ajouterTeacher']);
	Route::get('admin/element_constitutif/ajouter-enseignant/{class}/{parcour}/{element}', ['as'=>'addTeacher_ec', 'uses'=>'EcController@addTeacher_ec']);
	Route::get('admin/element_constitutif/{class}/{parcour}/{id}/details-elements-constitutifs', ['as'=>'checkElement', 'uses'=>'EcController@checkElement']);
	Route::get('admin/ec/impression/{class}/{parcour}', ['as'=>'print_element', 'uses'=>'EcController@print_element']);
	Route::post('admin/element_constitutif/{class}/{parcour}/{element}', 'EcController@rajouter');
	Route::get('admin/matiere_tronc_commun/{element_id}/fafana', ['as'=>'delete_tronc', 'uses'=>'EcController@purge']);

	// Payement Settings
	Route::get('admin/payement-settings/type', ['as'=>'typeControle', 'uses'=>'AdminController@type']);
	Route::get('admin/payement-settings/addtype', ['as'=>'addtype', 'uses'=>'AdminController@addtype']);
	Route::post('admin/payement-settings/storetype', ['as'=>'storetype', 'uses'=>'AdminController@storetype']);

	Route::post('admin/payement-settings/update/type/{id}', ['as'=>'update_type', 'uses'=>'AdminController@update_type']);

	Route::get('admin/payement-settings/motif', ['as'=>'motifControle', 'uses'=>'AdminController@motif']);
	Route::get('admin/payement-settings/regles', ['as'=>'regleControle', 'uses'=>'AdminController@regle']);
	//---> controle payment
	Route::get('admin/payement-controle/list', ['as'=>'chekpay', 'uses'=>'AdminController@checkpay']);
	Route::get('admin/payement-controle/view/{id}', ['as'=>'viewDetail_pay', 'uses'=>'AdminController@viewDetail_pay']);

	Route::get('admin/payement-controle/valid/{id}', ['as'=>'validPay', 'uses'=>'AdminController@validPay']);

	Route::get('admin/payment-controle/addPay/{id}', ['as'=>'addPay', 'uses'=>'AdminController@addPay']);
	
	Route::post('admin/payment-controle/store-by-esige/{id}', ['as'=>'addPay_byscol', 'uses'=>'AdminController@addPay_byscol']);

	// Other Way add pay by Scol
	Route::get('admin/payment-controle/add_pay', ['as'=>'pay_stud_Class', 'uses'=>'AdminController@pay_stud_Class']);

	Route::get('admin/payment-controle/add_pay/{class}', ['as'=>'pay_stud_Parcour', 'uses'=>'AdminController@pay_stud_Parcour']);

	Route::get('admin/payment-controle/add_pay/{class}/{parcour}', ['as'=>'pay_by_Studliste', 'uses' => 'AdminController@pay_by_Studliste']);
	//---> End payment

	//---------> Add Supports Cours
	Route::get('admin/cours/page-ajouter', ['as'=>'checkClassCours', 'uses'=>'SupportController@checkClassCours']);

	Route::get('admin/cours/page-ajouter/{class}', 	['as'=>'checkParcourCours', 'uses'=>'SupportController@checkParcourCours']);

	Route::get('admin/cours/page-ajouter/{class}/{parcour}', ['as'=>'checkVagueCours', 'uses'=>'SupportController@checkVagueCours']);

	Route::get('admin/cours/page-ajouter/{class}/{parcour}/{vague}', ['as'=>'formCours', 'uses'=>'SupportController@formCours']);

	Route::post('admin/cours/page-ajouter/{class}/{parcour}/{vague}', ['as'=>'CoursStore', 'uses'=>'SupportController@CoursStore']);

	Route::get('admin/cours/detail/{id}', ['as'=>'detailCours', 'uses'=>'SupportController@detail']);
	Route::get('admin/cours/partager/{id}', ['as'=>'shareCours', 'uses'=>'SupportController@shareCours']);
	Route::post('admin/cours/partager-send/{id}', ['as'=>'shareLesson', 'uses'=>'SupportController@share']);

	Route::get('admin/cours/delete/{id}', ['as'=>'deleteSupport', 'uses'=>'SupportController@delete']);

});

//--> only student can access here
Route::group(['before'=>'student'], function(){

	Route::get('etudiant/esapce-etudiant/bienvenu', ['as'=>'panel.student', 'uses'=>'ProfilController@index']);

	//--------> Payement
	Route::get('etudiant/paiement/page', ['as'=>'index_pay', 'uses'=>'PayController@index']);

	Route::get('etudiant/paiement/page/ecolage/{id}', ['as'=>'typepay', 'uses'=>'PayController@typepay']);
	Route::get('etudiant/paiement/formulaire/{token}/{id}/{same}/{motif}', ['as'=>'addStudpay', 'uses'=>'PayController@addStudPay']);

	Route::post('etudiant/paiement/paystore/{token}/{id}', ['as'=>'payStore', 'uses'=>'PayController@payStore']);

	Route::get('etudiant/paiement/listes', ['as'=>'listes_stud', 'uses'=>'PayController@listes_stud']);

	Route::get('etudiant/paiement/info-detail/{token}', ['as'=>'infopay_stud', 'uses'=>'PayController@infopay_stud']);

	Route::get('etudiant/payement-notification/lire/{token}', ['as'=>'readnotifypay', 'uses'=>'PayController@readnotifypay']);
	// End payment Student

	//------> Cours pour étudiant
	Route::get('etudiant/mon-cours/page', ['as'=>'cours_index', 'uses'=>'CourController@index']);
	
	Route::get('etudiant/mon-cours/details/{id}/{token}', ['as'=>'showLesson', 'uses'=>'CourController@showLesson']);

	//-----> Profile 

	Route::get('etudiant/mon-profile/{token}', ['as'=>'studprofile', 'uses'=>'ProfilController@profile']);

	Route::post('etudiant/mon-profile/mis-a-jour/{token}', ['as'=>'update_profile', 'uses' => 'ProfilController@update']);

	Route::post('etudiant/mis-a-jour/photo-profil/{token}', ['as'=>'photoStudent', 'uses'=>'ProfilController@photoStudent']);

	Route::get('etudiant/photo/{token}/supprimer', ['as'=>'delete_photo', 'uses'=>'ProfilController@delete_photo']);

	Route::post('etudiant/profile/{token}/mot-de-passe', ['as'=>'student_update_password', 'uses'=>'ProfilController@student_update_password']);

});	