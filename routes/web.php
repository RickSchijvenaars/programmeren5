<?php

Route::get('/', 'PhotosController@home');

Route::get('/photos', 'PhotosController@index');

Route::get('/upload', 'PhotosController@upload' );
Route::post('/photos', 'PhotosController@store' );

Route::get('/photos/{photo}', 'PhotosController@details' );

Route::post('/photos/{photo}/comments', 'CommentsController@store' );

Route::get('/home', 'HomeController@index');

Auth::routes();