<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
	protected $table = 'activities';
	protected $fillable = [  "user", "name", "description", "level" , "created_at" , "updated_at" ];
	protected $hidden = [ "updated_at" ];

	public function createActivity($user = null , $name = 'Others' , $description = '', $level = 0){
		$this->user = $user->id;
		$this->name = $name;
		$this->description = $description;
		$this->level = $level;
		$this->save();
	}
	
	function getUser()
	{
		return $this->belongsTo('App\User' , 'user');
	}
}
