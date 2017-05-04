<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    //
    protected $table = 'teachers';

	protected $guarded = array('id');

	public function proc()
    {
        return $this->hasOne('App\Proc','teacher_id','id');
    }
    public function orgAdvisor()
    {
    	return $this->hasMany('App\OrgAdvisor','advisor_id','id');
    }
    public function dept()
    {
        return $this->belongsTo('App\Department','dept_id','id');
    }
    
	
}
