<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interactive extends Model
{
	protected $table = 'interactives';

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = [ "exam_id", "step", "title", "desc", "image" ];

	/**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
	protected $hidden = [ "created_at" , "updated_at" ];
}
