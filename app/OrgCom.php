<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrgCom extends Model
{
    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'org_coms';

	protected $guarded = array('student_id');

	protected $fillable = ['designation'];

	/**
     * Get the user id.
     */
	public function organization()
    {
        return $this->belongsTo('App\Organization','org_id','id');
    }
    public function student(){
    	return $this->belongsTo('App\Student', 'student_id', 'id');
    }
}
