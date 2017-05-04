<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $table = 'schools';



	/**
     * Get the user id.
     */
	public function department()
    {
        return $this->hasMany('App\Department','school_id','id');
    }

    
}
