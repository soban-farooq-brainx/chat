<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Message extends Model
{
    //
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function sender()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function receiver()
    {
        return $this->belongsTo('App\User', 'receiver_id');
    }

    public function group()
    {
        return $this->belongsTo('App\Group');
    }

}
