<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admins')->middleware(['auth', 'admins'])->group(function ()
{
    Route::resource('categories', 'CategoryController');

    Route::resource('blogs', 'BlogController');
    Route::resource('tags', 'TagController');
});

Route::prefix('users')->name('users.')->middleware(['auth', 'users'])->group(function () {
    Route::get('/categories','CategoryController@userindex')->name('categories.index');
});
