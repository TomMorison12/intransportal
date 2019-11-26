<?php

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

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Route::resource('forum/threads', 'ThreadsController');

Route::get('/forum/threads/', 'ThreadsController@index');
Route::get('/forum/threads/create', 'ThreadsController@create');
Route::get('/forum/threads/{channel}/{thread}', 'ThreadsController@show');
Route::post('/forum/threads', 'ThreadsController@store');
Route::post('forum/threads/{channel}/{thread}/replies','RepliesController@store');
Route::get('/forum/threads/{channel}', 'ThreadsController@index');
Route::post('/forum/replies/{reply}/favorite', 'FavoritesController@store');

Route::resource('photos', 'PhotosController');
