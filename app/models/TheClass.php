<?php

class TheClass extends Eloquent {

	protected $guarded = ['id', 'created_at'];

	protected $table = 'niveaux';

	public function ue()
	{
	    return $this->belongsTo('UE', 'class_id');
	}

}