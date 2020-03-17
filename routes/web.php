<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'MessageController@index')->name('chat.index');


Auth::routes();


//Route::get('/conversations', 'MessageController@index')->name('conversation.home');

// axios routes

// get all users
Route::post('/users', 'MessageController@users')->name('conversations.users');

// get all conversations
Route::get('/conversations', 'MessageController@conversations')->name('conversations.all');

// get a specific conversation
Route::get('/conversation/{id}', 'MessageController@show')->name('conversation.show');

// send message
Route::post('/send-message', 'MessageController@sendMessage')->name('conversation.send');

// get logged in user
Route::get('/user', 'UserController@user')->name('user.signedInUser');

Route::get('/test', 'MessageController@test');
