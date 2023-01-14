<?php

class Reset extends Eloquent {
	

	protected $guarded = ['id', 'created_at'];

	protected $table = 'password_reminders';


}