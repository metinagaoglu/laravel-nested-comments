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

Route::get('/post/{id}', 'App\Http\Controllers\API\PostController@show');
Route::get('/post/{id}/comment', 'App\Http\Controllers\API\CommentController@index');
Route::post('/post/{id}/comment', 'App\Http\Controllers\API\CommentController@store');
