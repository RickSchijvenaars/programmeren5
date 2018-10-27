<?php

Route::get('/', 'HomeController@index')->name('home');

Route::get('/gallery', 'PhotosController@index')->name('gallery');

Route::get('/upload', 'PhotosController@upload' )->middleware('auth')->name('upload');
Route::post('/store', 'PhotosController@store' )->middleware('auth')->name('store');

Route::get('/photos/{photo}', 'PhotosController@details' )->name('details');

Route::post('/photos/{photo}/comments', 'CommentsController@store' )->name('comment');

Route::get('/profile', 'UserController@profile')->middleware('auth')->name('userprofile');
Route::post('/profile', 'UserController@edit' )->middleware('auth')->name('edituser');

Route::get('/admin', 'AdminController@index')->middleware('admin')->name('adminpanel');
Route::post('/admin/update/{user}', 'AdminController@userUpdate')->middleware('admin')->name('userupdate');
Route::post('/admin/update/{photo}', 'AdminController@photoUpdate')->middleware('admin')->name('photoupdate');


Auth::routes();