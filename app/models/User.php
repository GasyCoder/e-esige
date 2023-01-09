<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	protected $guarded = ['id', 'created_at'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');


	public function children()
	{
	    return $this->hasMany('User', 'guardian_id');
	}

	public function parent()
	{
	    return $this->belongsTo('User', 'guardian_id');
	}


	public function studClass()
	{
	    return $this->belongsTo('TheClass', 'class_id');
	}


	public function teacher()
	{
	    return $this->belongsTo('TheTeacher', 'teacher_id');
	}



}
