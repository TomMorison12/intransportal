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


$domain = parse_url('http://intransportal.com', PHP_URL_HOST);


Route::domain('forum.'.$domain)->group(function() {
    Route::get('/threads', 'ThreadsController@index');
    Route::get('/threads/create', 'ThreadsController@create');
    Route::get('/threads/{channel}/{thread}', 'ThreadsController@show');
    Route::delete('/threads/{channel}/{thread}', 'ThreadsController@destroy');
    Route::post('/threads', 'ThreadsController@store');
    Route::get('/threads/{channel}/{thread}/replies','RepliesController@index');
    Route::post('/threads/{channel}/{thread}/replies','RepliesController@store');
    Route::post('/threads/{channel}/{thread}/subscribe', 'ThreadSubscriptionsController@store')->middleware('verified');
    Route::delete('/threads/{channel}/{thread}/subscribe', 'ThreadSubscriptionsController@destroy')->middleware('verified');
    Route::get('/threads/{channel}', 'ThreadsController@index');
    Route::patch('/replies/{reply}', 'RepliesController@update');
    Route::delete('/replies/{reply}', 'RepliesController@destroy');
    Route::post('/replies/{reply}/favorite', 'FavoritesController@store');
    Route::delete('/replies/{reply}/favorite','FavoritesController@destroy');
    Route::get('/', 'ThreadsController@index');
    Route::patch('/replies/{reply}', 'RepliesController@update');

    Route::get('profiles/{user}/notifications', 'UserNotificationsControlller@index');
    Route::get('api/users', 'Api\UsersController@index');



    Auth::routes(['verify' => true]);

});

Route::domain($domain)->group(function() {
    Route::get('/','HomeController@index');
    Auth::routes();
    Route::get('profiles/{user}', 'ProfilesController@show')->name('profile');
    Route::delete('profiles/{user}/notifications/{notification}', 'UserNotificationsControlller@destroy');
    Route::get('profiles/{user}/notifications', 'UserNotificationsControlller@index');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::post('api/users/{user}/avatar', 'Api\UserAvatarController@store');
    Route::post('api/category/add', 'CategoryController@store');
    Route::resource('photos', 'PhotosController');
});

