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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route::resource('users','AccountController')->only(['edit','show','update']);

Route::get('/account','AccountController@show')->name('users.show')->middleware('auth');

Route::get('/account/edit','AccountController@edit')->name('users.edit')->middleware('auth');

Route::patch('/account/edit/{user}','AccountController@update')->name('users.update')->middleware('auth');

Route::resource('posts','PostController')->except(['index','show'])->middleware('auth');

Route::resource('posts','PostController')->only(['index','show']);
