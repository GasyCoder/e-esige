<?php

class Student extends Eloquent {
	

	protected $guarded = ['id', 'created_at'];

	protected $table = 'students';

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

	public function user() {
		return $this->belongsTo('Profil', 'id');
	}

	public function verify() {
		return $this->belongsTo('Paycontrol', 'id');
	}
}