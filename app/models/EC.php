<?php

class EC extends Eloquent {
	
	protected $guarded = ['id', 'created_at'];

	protected $table = 'elements';

	public function niveau()
	{
	    return $this->belongsTo('TheClass', 'class_id');
	}

	public function parcour()
	{
	    return $this->belongsTo('Parcour', 'parcour_id');
	}

	public function tronc()
	{
	    return $this->belongsTo('Tronc', 'parcour_id');
	}

	public function unite()
	{
	    return $this->belongsTo('UE', 'codeUe');
	}

	public function teacher()
	{
	    return $this->belongsTo('Teacher', 'id_teacher');
	}
}