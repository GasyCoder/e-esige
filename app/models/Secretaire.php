<?php

class Secretaire extends Eloquent
{
	protected $guarded = ['id', 'created_at'];

	protected $table = 'secretaires';

	public function user() {
		return $this->belongsTo('Profil', 'token');
	}
}