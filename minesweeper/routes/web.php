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
    return view('home');
});


Route::get('/games', 'GamesController@index');
Route::get('/games/{game}/play', 'GamesController@show');
Route::get('/newGame', 'GamesController@create');
Route::post('/games', 'GamesController@store');
Route::post('/games/{game}/events', 'SquaresController@valildateClick');
Route::get('/ContinueGame', 'GamesController@index');
