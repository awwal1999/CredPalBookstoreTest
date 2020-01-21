<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->post('books/{book}/reviews', 'ReviewsController@store');
Route::get('books', 'BooksController@index');
Route::middleware(['auth:api', 'auth.admin'])->post('books', 'BooksController@store');

Route::post('login', 'LoginController@login');