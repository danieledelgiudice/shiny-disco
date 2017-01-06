<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/clienti', 'ClientiController@index');
Route::get('/clienti/{cliente}/edit', 'ClientiController@edit');
Route::get('/clienti/{cliente}', 'ClientiController@show');
Route::put('/clienti/{cliente}', 'ClientiController@update');


Route::get('/pratiche', 'PraticheController@index');
Route::get('/pratiche/{pratica}/edit', 'PraticheController@edit');
Route::put('/pratiche/{pratica}', 'PraticheController@update');
