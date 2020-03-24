<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function messages()
    {
        return $this->hasMany('App\Message');
    }

    public function group_has_groups()
    {
        return $this->hasMany('App\GroupHasUser');
    }
}
