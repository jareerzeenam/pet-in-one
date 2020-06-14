<?php

use Illuminate\Support\Facades\Route;

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



Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return view('welcome');
});

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/store', 'PostController');


Route::resource('/blog', 'BlogController');

Route::post('contact', 'ContactFormController@store');

// !

// !

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('{path}', 'HomeController@index')->where('path', '([A-z]+)?');
