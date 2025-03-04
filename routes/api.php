<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResources(['user' => 'API\UserController']);

Route::get('profile', 'API\UserController@profile');
Route::put('profile', 'API\UserController@UpdateProfile');

// !Posts
Route::apiResources(['post' => 'API\PostController']);
// !Blogs
Route::apiResources(['blog' => 'API\BlogController']);

// !Test
// Route::apiResources(['test' => 'API\TestController']);








// Route::get('product', 'API\PostController@product');
