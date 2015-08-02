<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    //
	
	protected $table = 'assessments';
	
		/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = [ "exam_id", "user_id", "status", "score" ];


	/**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [ "created_at" , "updated_at" ];
	
//	public function getLastAssement(){
//		return $this->hasMany('App\Question' , 'exam');
//	};
}
