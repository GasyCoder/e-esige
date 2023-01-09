<?php

class Teacher extends Eloquent
{
	protected $guarded = ['id', 'created_at'];

	protected $table = 'teachers';
	public $incrementing = false;

	public function class()
	{
	    return $this->belongsTo('TheClass', 'class_id');
	}

	public function parcour()
	{
	    return $this->belongsTo('Parcour', 'parcour_id');
	}

	public function user() {
		return $this->belongsTo('Profil', 'token');
	}
}