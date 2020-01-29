<?php

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('categories', 'CategoryController')->middleware('auth');

Route::resource('blogs', 'BlogController')->middleware('auth');
Route::resource('tags', 'TagController')->middleware('auth');
