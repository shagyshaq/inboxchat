<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('messages/create', 'MessagesController@formCreateMessage');
Route::any('messages/send', 'MessagesController@sendMessage');

Route::get('messages/count', 'MessagesController@formDashboard');

Route::get('messages/inbox', 'MessagesController@listMessageInbox');
Route::get('messages/sent', 'MessagesController@listMessageSent');

Route::get('messages/view/{id}', 'MessagesController@viewMessage');
Route::any('messages/forward', 'MessagesController@forwardMessage');
Route::any('messages/reply', 'MessagesController@replyMessage');


Route::any('users/login', 'UsersController@getLogin');
Route::get('users/logout', 'UsersController@getLogOut');

Route::any('users/signin', 'UsersController@postSignIn');
Route::any('users/dashboard', 'UsersController@getDashboard');

Route::any('users/register', 'UsersController@registerUser');

Route::any('users/listusers', 'UsersController@listUsers');
Route::any('users/edituser/{id}', 'UsersController@editUser');
Route::any('users/edit', 'UsersController@updateOrCreateUser');
Route::any('users/delete/{id}', 'UsersController@deleteUser');
Route::any('users/create', 'UsersController@createUser');
Route::any('users/deactivateuser/{id}', 'UsersController@deactivateUser');
Route::any('users/activateuser/{id}', 'UsersController@activateUser');




