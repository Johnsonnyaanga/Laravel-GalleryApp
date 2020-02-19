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

use App\Http\Controllers\AlbumsController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', 'AlbumsController@index');
Route::get('/albums/create', 'AlbumsController@create');
Route::get('/albums', 'AlbumsController@index');
Route::post('/albums/store', 'AlbumsController@store');
Route::get('/albums/{id}', 'AlbumsController@show');
//Route::get('user/{id}', 'UserController@show');
