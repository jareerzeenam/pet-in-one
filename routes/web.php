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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('ui.about');
});

Route::get('/store', function () {
    return view('ui.store');
});

Route::get('/blog', function () {
    return view('ui.blog');
});

Route::get('/contact', function () {
    return view('ui.contact');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('{path}', 'HomeController@index')->where('path', '([A-z]+)?');
