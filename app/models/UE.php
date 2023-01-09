<?php

class UE extends Eloquent {
	
	protected $guarded = ['id', 'created_at'];

	protected $table = 'ues';

	public function niveau()
	{
	    return $this->belongsTo('TheClass', 'class_id');
	}

	public function sem()
	{
	    return $this->belongsTo('Sem', 'semestre_id');
	}

	public function parcour()
	{
	    return $this->belongsTo('Parcour', 'parcour_id');
	}


    public function elements()
    {
        return $this->hasMany('EC');
    }

}