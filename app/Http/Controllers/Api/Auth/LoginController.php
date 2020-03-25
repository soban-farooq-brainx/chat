<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login()
    {
        $cred = \request()->only(['email', 'password']);
        // if cred not correct.
        if (!$token = auth()->attempt($cred))
            return response()
                ->json(['error' => 'Incorrect email/password. Could not authorize'], 401);
        // return response;
        return response()->json(['token' => $token]);
    }


    public function refresh()
    {
        try {
            $newToken = auth()->refresh();
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $exception) {
            return response()->json(['error' => $exception], 401);
        }

        return response()->json(['token' => $newToken], 201);
    }
}
