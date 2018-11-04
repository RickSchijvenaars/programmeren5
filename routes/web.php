<?php

Route::get('/', 'HomeController@index')->name('home');

Route::get('/gallery', 'PhotosController@index')->name('gallery');

Route::get('/upload', 'PhotosController@upload' )->middleware('auth')->name('upload');
Route::post('/store', 'PhotosController@store' )->middleware('auth')->name('store');

Route::get('/photos/{photo}', 'PhotosController@details' )->name('details');

Route::post('/photos/{photo}/comments', 'CommentsController@store' )->name('comment');

Route::get('/delete/{id}', 'CommentsController@delete')->middleware('auth')->name('deletecomment');

Route::get('/profile', 'UserController@profile')->middleware('auth')->name('userprofile');
Route::post('/profile', 'UserController@edit' )->middleware('auth')->name('edituser');


Route::group( ['middleware' => 'admin' ], function()
{
    Route::get('/admin', 'AdminController@index')->middleware('admin')->name('adminpanel');
    Route::post('/admin/update/role/{id}', 'AdminController@updateRole')->middleware('admin')->name('updaterole');

    Route::post('/admin/edit/user/{id}', 'AdminController@editUser')->middleware('admin')->name('adminedituser');
    Route::post('/admin/update/user/{user}', 'AdminController@updateUser')->middleware('admin')->name('userupdate');
    Route::post('/admin/edit/photo/{id}', 'AdminController@editPhoto')->middleware('admin')->name('admineditphoto');
    Route::post('/admin/update/photo/{photo}', 'AdminController@updatePhoto')->middleware('admin')->name('photoupdate');

    Route::post('/admin/delete/user/{id}', 'AdminController@deleteUser')->middleware('admin')->name('deleteuser');
    Route::post('/admin/delete/photo/{id}', 'AdminController@deletePhoto')->middleware('admin')->name('deletephoto');
    Route::post('/admin/delete/category/{id}', 'AdminController@deleteCategory')->middleware('admin')->name('deletecategory');

    Route::post('/admin/add', 'AdminController@addCategory')->middleware('admin')->name('addcategory');
});


Auth::routes();