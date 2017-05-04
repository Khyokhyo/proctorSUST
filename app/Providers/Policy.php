<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'policies';

	protected $fillable = ['content'];

	/**
     * Get the user id.
     */
	
}
