<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $table = 'attachments';

	protected $guarded = array('notice_id');


	/**
     * Get the user id.
     */
	public function notice()
    {
        return $this->belongsTo('App\Notice','notice_id','id');
    }
}
