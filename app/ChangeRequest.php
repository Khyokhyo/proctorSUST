<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChangeRequest extends Model
{
    //
    protected $table = 'change_requests';

	protected $guarded = array('org_id');


	/**
     * Get the user id.
     */
	public function organization()
    {
        return $this->belongsTo('App\Organization','org_id','id');
    }
}
