<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proc extends Model
{
    //
    protected $table = 'procs';

	protected $guarded = array('user_id');

	protected $fillable = ['designation'];

	/**
     * Get the user id.
     */
	public function user()
    {
        return $this->belongsTo('User','user_id','id');
    }
    public function teacher(){
    	return $this->belongsTo('App\Teacher', 'teacher_id', 'id');
    }
    public function notice()
    {
        return $this->hasMany('App\Notice','sender_id','id');
    }
}
