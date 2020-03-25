<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/groups', 'Api\GroupMessageController@getGroupsOfCurrentUser');
Route::get('/group/{group_id}', 'Api\GroupMessageController@getGroupMessages');
Route::post('/group/send-message', 'Api\GroupMessageController@sendAGroupMessage');
Route::post('/group/store', 'Api\GroupMessageController@createGroup');
Route::post('/group/user/add', 'Api\GroupMessageController@addUserToGroup');
Route::delete('/group/user/leave/{group_id}', 'Api\GroupMessageController@leaveGroup');


// auth
Route::post('/login', 'Api\Auth\LoginController@login');
Route::post('/refresh', 'Api\Auth\LoginController@refresh');
