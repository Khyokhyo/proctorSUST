<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments';

	/**
     * Get the user id.
     */
	public function school()
    {
        return $this->belongsTo('App\School','school_id','id');
    }

    public function teacher()
    {
        return $this->hasOne('App\Teacher','dept_id','id');
    }

    public function student()
    {
        return $this->hasMany('App\Student','dept_id','id');
    }
}
