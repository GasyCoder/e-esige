<?php

class Profil extends Eloquent {
	

	protected $guarded = ['id', 'created_at'];

	protected $table = 'profiles';

    /*public function student()	
	{
	    return $this->belongsTo('Student', 'id');
	}*/


}