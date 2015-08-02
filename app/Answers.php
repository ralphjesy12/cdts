<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answers extends Model
{
  	
	protected $table = 'answers';
	
		/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = [  "user_id", "exam_id", "question_id", "assessment_id", "answer" ];


	/**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [ "created_at" , "updated_at" ];
}
