<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//**************** AdminController Routes and Retrieve Data to Admin Area ******************|
//------------------------------------------------------------------------------------------|

// Admin login
Route::get('/admin/login', 'AdminController@showAdminLogin');
Route::post('/admin/login', 'AdminAuth\AuthController@postLogin' );
Route::get('/admin/logout', 'AdminAuth\AuthController@logout');

// Admin Register
Route::get('/admin/register', 'AdminController@showRegister');
Route::post('/admin/register', 'AdminAuth\AuthController@postRegister');

// Admin Password
Route::get('/admin/password', 'AdminController@showChangePassword');
Route::post('/admin/password/sukses', ['as' => '/admin/password/sukses', 'middleware' => 'admin', 'uses' => 'AdminController@saveChangePassword']);

// Admin Index Area
Route::get('/admin', ['middleware' => 'admin', 'uses' => 'AdminController@Index']);

// Post
Route::get('/admin/mbojo', ['middleware' => 'admin', 'uses' => 'AdminController@ShowPost']);
Route::get('/admin/data-mbojo', ['middleware' => 'admin', 'uses' => 'AdminController@ShowDataPost']);
Route::post('/admin/tambah-mbojo-sukses', ['middleware' => 'admin', 'uses' => 'AdminController@SavePost']);
Route::get('/admin/mbojo-edit/{id}', ['middleware' => 'admin', 'uses' => 'AdminController@PostEdit'])->where('id', '[0-9]+');
Route::post('/admin/mbojo-edit-sukses', ['middleware' => 'admin', 'uses' => 'AdminController@PostEditSave']);
Route::delete('/admin/mbojo-hapus/{id}', ['as' => '/admin/mbojo-hapus/', 'middleware' => 'admin', 'uses' => 'AdminController@DestroyPost'])->where('id', '[0-9]+');
Route::delete('/admin/mbojo-multi/hapus/', ['as' => '/admin/mbojo-multi-hapus/', 'middleware' => 'admin', 'uses' => 'AdminController@MultiDestroyPost'])->where('id', '[0-9]+');

// Category
Route::post('/admin/tambah-kategori-sukses', ['middleware' => 'admin', 'uses' => 'AdminController@SaveCategory']);
Route::post('/admin/kategori-edit-sukses', ['middleware' => 'admin', 'uses' => 'AdminController@CategoryEditSave']);
Route::delete('/admin/kategori-hapus/{id}', ['as' => '/admin/kategori-hapus/', 'middleware' => 'admin', 'uses' => 'AdminController@DestroyCategory'])->where('id', '[0-9]+');

//-----------------User-----------------------//
// Home
Route::get('/', 'ViewController@home');

// Search
Route::get('query', 'ViewController@search');

// Post
Route::get('/mbojo', 'ViewController@AllContent');
Route::get('/mbojo/{post_title}', 'ViewController@Single');

// Kategori
Route::get('/kategori/{slug}', 'ViewController@Category');


	

Route::post('/', 'ViewController@sendMail');
