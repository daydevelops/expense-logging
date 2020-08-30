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

Route::get('/', 'LogController@index')->middleware('auth');
Route::get('/new','LogController@create')->middleware('auth');
Route::post('/logs','LogController@store')->middleware('auth');
Route::get('/archived','LogController@archived')->middleware('auth');
Route::delete('/logs/{log}','LogController@destroy')->middleware('auth');
Route::post('/archive','LogController@archive')->middleware('auth');

Auth::routes();


Route::get('/categories','CategoryController@index')->middleware('auth');
Route::get('categories/new','CategoryController@create')->middleware('auth');
Route::post('/categories','CategoryController@store')->middleware('auth');
Route::delete('/categories/{category}','CategoryController@destroy')->middleware('auth');
Route::patch('/categories/{category}','CategoryController@update')->middleware('auth');
