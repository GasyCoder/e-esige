<?php

class Paycontrol extends Eloquent {
	

	protected $guarded = ['id', 'created_at'];

	protected $table = 'paycontrol';

	public function class()
	{
	    return $this->belongsTo('TheClass', 'class_id');
	}

	public function parcour()
	{
	    return $this->belongsTo('Parcour', 'parcour_id');
	}
}