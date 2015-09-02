<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    
	protected $table = 'events';
	protected $fillable = [ "title", "class", "url", "start", "end" ];

	/**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [ "created_at" , "updated_at" ];
}
