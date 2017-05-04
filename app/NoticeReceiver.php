<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NoticeReceiver extends Model
{
    protected $table = 'notice_receivers';

	/**
     * Get the user id.
     */
	public function user()
    {
        return $this->belongsTo('App\User','receiver_id','id');
    }
    public function notice(){
    	return $this->belongsTo('App\Notice', 'notice_id', 'id');
    }
}
