<?php

class Pay extends Eloquent {
	

	protected $guarded = ['id', 'created_at'];

	protected $table = 'payments';

    public function class()
	{
	    return $this->belongsTo('TheClass', 'class_id');
	}

	public function parcour()
	{
	    return $this->belongsTo('Parcour', 'parcour_id');
	}

	public function user() 
	{
		return $this->belongsTo('Profil', 'id');
	}

	public function student()
	{
		return $this->belongsTo('Student', 'id');
	}


}