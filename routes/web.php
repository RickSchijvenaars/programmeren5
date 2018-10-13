<?php

Route::get('/', 'HomeController@index');

Route::get('/photos', 'PhotosController@index');

Route::get('/upload', 'PhotosController@upload' )->middleware('auth');
Route::post('/photos', 'PhotosController@store' );

Route::get('/photos/{photo}', 'PhotosController@details' );

Route::post('/photos/{photo}/comments', 'CommentsController@store' );

Route::get('/profile', 'UserController@profile')->middleware('auth');

Route::get('/admin', 'AdminController@index')->middleware('admin');

Auth::routes();