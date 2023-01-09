<?php

class Parcour extends Eloquent {
	
	protected $guarded = ['id', 'created_at'];

	protected $table = 'parcours';


	public function niveau()
	{
	    return $this->belongsTo('TheClass', 'class_id');
	}

	public function ecolages()
	{
	    return $this->hasMany('Pay', 'parcour_id');
	}

}