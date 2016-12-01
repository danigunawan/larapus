<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'GuestController@index');
Route::get('/contoh', 'GuestController@index');

Route::get('/about','MyController@showAbout');

Route::get('/testmodel', function() { $query = App\Post::all();  return $query; });



Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => 'web'], function () {

Route::group(['prefix'=>'admin', 'middleware'=>['auth','role:admin']], function () {

Route::resource('authors', 'AuthorController'); 
Route::resource('books', 'BookController');
Route::resource('members', 'MembersController');
	

 // Route diisi disini...


  });

  });

Route::get('books/{book}/borrow', [
'middleware' => ['auth', 'role:member'],
'as' => 'guest.books.borrow',
'uses' => 'BookController@borrow'
]);


Route::put('books/{book}/return', [
'middleware' => ['auth', 'role:member'],
'as' => 'member.books.return',
'uses' => 'BookController@returnBack'
]);

Route::get('auth/verify/{token}', 'Auth\RegisterController@verify');

Route::get('auth/send-verification', 'Auth\RegisterController@sendVerification');

//route untuk semua logic profil
Route::get('settings/profile', 'SettingsController@profile');
Route::get('settings/profile/edit', 'SettingsController@editProfile');
Route::post('settings/profile', 'SettingsController@updateProfile');

Route::get('settings/password', 'SettingsController@editPassword');
Route::post('settings/password', 'SettingsController@updatePassword');


