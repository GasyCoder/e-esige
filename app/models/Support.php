<?php

class Support extends Eloquent {
	
	protected $guarded = ['id', 'created_at'];

	protected $table = 'supports';

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
	    return $this->belongsTo('EC', 'matiere_id');
	}

}