<?php

class Lesson extends Eloquent {
	
	protected $guarded = ['id', 'created_at'];

	protected $table = 'lessons';

	public function class()
	{
	    return $this->belongsTo('TheClass', 'class_id');
	}

	public function parcour()
	{
	    return $this->belongsTo('Parcour', 'parcour_id');
	}

	public function vague()
	{
	    return $this->belongsTo('Vague', 'vague_id');
	}

	public function matiere()
	{
	    return $this->belongsTo('EC', 'id_matiere');
	}

	public function support()
	{
	    return $this->belongsTo('Support', 'id_cour');
	}

	public function student()
	{
	    return $this->belongsTo('Student', 'id_student');
	}
}