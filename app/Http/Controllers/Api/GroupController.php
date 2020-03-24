<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    //
    public function allUsers() {
        return User::all();
    }
}
