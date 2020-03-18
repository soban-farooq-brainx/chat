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
        $user = Auth::id();
        return $this->belongsTo('App\User')->where('id', '=', $user);
    }

    public function receiver()
    {
        $user = Auth::id();
        return $this->belongsTo('App\User')->where('id', '!=', $user);
    }


}
