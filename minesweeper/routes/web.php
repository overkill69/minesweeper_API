<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', function () {
    return view('home');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/boards', 'HomeController@boards');
    Route::get('/boards/{game}', 'HomeController@show');
    Route::get('/new-game', 'HomeController@create');
    //Route::post('/games', 'GamesController@store');
    Route::put('/games/{game}/events', 'SquaresController@update');    
    Route::get('/games/{game}', 'GamesController@show');    
});

Route::get('/home', 'HomeController@index')->name('home');
