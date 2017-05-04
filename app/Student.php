<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';

	protected $guarded = array('id');

	public function orgCom()
    {
        return $this->hasMany('App\OrgCom','student_id','id');
    }
    public function dept()
    {
        return $this->belongsTo('App\Department','dept_id','id');
    }
}
