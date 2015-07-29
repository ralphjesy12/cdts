<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
     protected $table = 'questions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ "exam", "title", "choices" ];
    
 

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [ "created_at" , "updated_at" ];
}
