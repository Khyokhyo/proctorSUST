<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrgAdvisor extends Model
{
    //
    protected $table = 'org_advisors';

	protected $guarded = array('org_id');

	/**
     * Get the user id.
     */
	public function organization()
    {
        return $this->belongsTo('App\Organization','org_id','id');
    }
    public function teacher(){
    	return $this->belongsTo('App\Teacher', 'advisor_id', 'id');
    }
}
