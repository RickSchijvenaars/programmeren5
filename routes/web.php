<?php

Route::get('/', 'HomeController@index')->name('home');

Route::get('/album', 'PhotosController@index')->name('photos');

Route::get('/upload', 'PhotosController@upload' )->middleware('auth')->name('upload');
Route::post('/photos', 'PhotosController@store' );

Route::get('/photos/{photo}', 'PhotosController@details' )->name('details');

Route::post('/photos/{photo}/comments', 'CommentsController@store' )->name('comment');

Route::get('/profile', 'UserController@profile')->middleware('auth')->name('userprofile');

Route::get('/admin', 'AdminController@index')->middleware('admin')->name('adminpanel');

Auth::routes();