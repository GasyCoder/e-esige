<?php

class Year extends Eloquent {
	
	protected $guarded = ['id', 'created_at'];

	protected $table = 'years';

}