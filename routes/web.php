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


$domain = parse_url('http://intransportal.test', PHP_URL_HOST);


Route::domain('forum.'.$domain)->group(function() {
    Route::get('/threads', 'ThreadsController@index')->name('threads');
    Route::get('/threads/create', 'ThreadsController@create');
    Route::get('/threads/{channel}/{thread}', 'ThreadsController@show');
    Route::post('locked-thread/{thread}', 'Api\LockedThreadsController@store')->name('locked-threads.store');
    Route::patch('/threads/{channel}/{thread}', 'ThreadsController@update');
    Route::delete('/threads/{channel}/{thread}', 'ThreadsController@destroy');
    Route::post('/threads', 'ThreadsController@store');
    Route::get('/threads/{channel}/{thread}/replies','RepliesController@index');
    Route::post('/threads/{channel}/{thread}/replies','RepliesController@store');
    Route::post('/threads/{channel}/{thread}/subscribe', 'ThreadSubscriptionsController@store')->middleware('verified');
    Route::delete('/threads/{channel}/{thread}/subscribe', 'ThreadSubscriptionsController@destroy')->middleware('verified');
    Route::get('/threads/{channel}', 'ThreadsController@index');
    Route::patch('/replies/{reply}', 'RepliesController@update');
    Route::delete('/replies/{reply}', 'RepliesController@destroy')->name('replies.delete');
    Route::post('/replies/{reply}/favorite', 'FavoritesController@store');
    Route::delete('/replies/{reply}/favorite','FavoritesController@destroy');
    Route::post('/replies/{reply}/best', 'BestRepliesController@store');

    Route::get('/', 'ThreadsController@index');
    Route::patch('/replies/{reply}', 'RepliesController@update');

    Route::get('profiles/{user}/notifications', 'UserNotificationsControlller@index');
    Route::get('api/users', 'Api\UsersController@index');



    Auth::routes(['verify' => true]);

});

Route::domain('wiki.'.$domain)->group(function() {
    Route::get('/', 'CategoryController@index')->name('wiki.index');
    Route::get('api/categories', 'Api\CategoryController@show');
    Route::get('/{country}', 'CategoryController@show')->name('wiki.show');
    Route::post('api/category/add', 'Api\CategoryController@store')->name('country.add');
    Route::post('api/cities/add', 'Api\CitiesController@store')->name('cities.add');
    Route::delete('api/category/delete/{country}', 'Api\CategoryController@destroy')->middleware('admin')->name('country.delete');
    Route::get('api/cities/{country}', 'Api\CitiesController@show');
    Route::post('photos/add', 'PhotosController@store')->name('photos.add');

});

Route::domain($domain)->group(function() {
    Route::get('/','ThreadsController@index')->name('home');
    Auth::routes();
    Route::get('profiles/{user}', 'ProfilesController@show')->name('profile');
    Route::delete('profiles/{user}/notifications/{notification}', 'UserNotificationsControlller@destroy');
    Route::get('profiles/{user}/notifications', 'UserNotificationsControlller@index');
    Route::post('api/users/{user}/avatar', 'Api\UserAvatarController@store');

});



