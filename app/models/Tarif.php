<?php

class Tarif extends Eloquent {
	
	protected $guarded = ['id', 'created_at'];

	protected $table = 'tarifs';

	public function niveau()
	{
	    return $this->belongsTo('TheClass', 'class_id');
	}


}