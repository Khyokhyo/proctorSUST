<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'organizations';

	protected $guarded = array('user_id');

	protected $fillable = ['name'];

	/**
     * Get the user id.
     */
	public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

    public function orgCom()
    {
        return $this->hasMany('App\OrgCom','org_id','id');
    }
    public function orgAdvisor()
    {
        return $this->hasMany('App\OrgAdvisor','org_id','id');
    }
    public function changeRequest()
    {
        return $this->hasMany('App\ChangeRequest','org_id','id');
    }
}
