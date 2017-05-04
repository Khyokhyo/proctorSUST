<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    //
    protected $table = 'notices';

	protected $guarded = array('sender_id');


	/**
     * Get the user id.
     */
	public function proc()
    {
        return $this->belongsTo('App\Proc','sender_id','id');
    }

    public function notice_receiver()
    {
        return $this->hasMany('App\NoticeReceiver','notice_id','id');
    }

    public function attachment()
    {
        return $this->hasOne('App\Attachment','notice_id','id');
    }
    
}
