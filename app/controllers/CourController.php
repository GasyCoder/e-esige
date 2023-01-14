<?php 

class CourController extends BaseController
{
	public function index()
	{
		$title   = 'Mes cours';
		$user    = Auth::user()->token;
		$stud    = Student::where('token', $user)->first();

		$lessons = Lesson::where('id_student', $stud->id)->where('status', 1)->get();

		/*$lessons = Lesson::where('class_id', $stud->class_id)
							->where('parcour_id', $stud->parcour_id)
							->where('vague_id', $stud->vague_id)
							->where('status', 1)
							->groupBy('id_cour')
							->get();*/

		return View::make('student.cours.index', compact('lessons', 'stud'))->with('title', $title);
	}

	public function showLesson($id, $token){

		$title = 'Detail de cours';
		$show  = Lesson::where('id_student', $id)->where('token', $token)->first();

		return View::make('student.cours.detail', compact('show'))->with('title', $title);
	}
}