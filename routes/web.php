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

Route::get('/', 'ConversationController@index')->name('chat.index');


Auth::routes();

//Route::get('/conversations', 'ConversationController@index')->name('conversation.home');

// axios routes

// get all users
Route::post('/users', 'ConversationController@users')->name('conversations.users');

// get all conversations
Route::get('/conversations', 'ConversationController@conversations')->name('conversations.all');

// get a specific conversation
Route::get('/conversations/{id}', 'ConversationController@show')->name('conversation.show');

// send message
Route::post('/send-message', 'ConversationController@sendMessage')->name('conversation.send');

// get logged in user
Route::get('/user', 'UserController@user')->name('user.signedInUser');
