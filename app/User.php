<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'user_type', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function proc()
    {
        return $this->hasOne('App\Proc','user_id','id');
    }

    public function organization()
    {
        return $this->hasOne('App\Organization','user_id','id');
    }

    public function notice_receiver()
    {
        return $this->hasMany('App\NoticeReceiver','receiver_id','id');
    }
}
