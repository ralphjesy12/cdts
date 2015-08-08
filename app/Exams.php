<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exams extends Model
{
	protected $table = 'exams';

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = [ "code", "title", "items", "attempts", "type", "status" ];



	/**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [ "created_at" , "updated_at" ];

	function questions()
	{
		return $this->hasMany('App\Question' , 'exam');
	}
	function interactives()
	{
		return $this->hasMany('App\Interactive' , 'exam_id');
	}
}
