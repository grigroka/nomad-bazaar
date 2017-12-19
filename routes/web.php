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

Route::get('/', function () {
    return view('pages.welcome');
});

Auth::routes();

Route::get('home', 'HomeController@index')->name('home');
Route::get('contact', 'PageController@getContact');
Route::post('contact', 'PageController@postContact');
Route::get('about', 'PageController@getAbout');
