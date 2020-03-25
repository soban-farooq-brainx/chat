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
        return $this->belongsTo('App\User', 'sender_id');
    }

    public function sender()
    {
        return $this->belongsTo('App\User', 'user_id');
    }


    public function group()
    {
        return $this->belongsTo('App\Group');
    }

}
