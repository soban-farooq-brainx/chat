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
Route::post('/send-message', 'Api\GroupMessageController@sendAGroupMessage');
