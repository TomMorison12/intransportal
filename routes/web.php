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
    Route::get('/threads', 'ThreadsController@index');
    Route::get('/threads/create', 'ThreadsController@create');
    Route::get('/threads/{channel}/{thread}', 'ThreadsController@show');
    Route::patch('/threads/{channel}/{thread}', 'ThreadsController@update')->name('threads.update');
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
    Route::get('/{category}', 'CategoryController@show')->name('wiki.show');
    Route::post('api/category/add', 'Api\CategoryController@store')->name('category.add');
    Route::post('api/subcategory/add', 'Api\SubcategoryController@store')->name('category.add');
    Route::get('api/category/{category}', 'Api\SubcategoryController@show')->name('subcategories.api');
    Route::get('api/category/', 'Api\CategoryController@show');

});

Route::domain($domain)->group(function() {
    Route::get('/','ThreadsController@index')->name('home');
    Auth::routes();
    Route::get('profiles/{user}', 'ProfilesController@show')->name('profile');
    Route::delete('profiles/{user}/notifications/{notification}', 'UserNotificationsControlller@destroy');
    Route::get('profiles/{user}/notifications', 'UserNotificationsControlller@index');
    Route::post('api/users/{user}/avatar', 'Api\UserAvatarController@store');

    Route::resource('photos', 'PhotosController');
});



