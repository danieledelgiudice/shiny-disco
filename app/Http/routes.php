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
Route::get('/clienti/{cliente}', 'ClientiController@show');
Route::get('/clienti/{cliente}/modifica', 'ClientiController@edit');
Route::put('/clienti/{cliente}', 'ClientiController@update');
Route::get('/clienti/nuovo', 'ClientiController@create');
Route::post('/clienti/salva', 'ClientiController@store');
Route::post('/clienti/filtra', 'ClientiController@filter');


Route::get('/pratiche', 'PraticheController@index');
Route::get('/pratiche/{pratica}', 'PraticheController@show');
Route::get('/pratiche/{pratica}/modifica', 'PraticheController@edit');
Route::put('/pratiche/{pratica}', 'PraticheController@update');
Route::get('/clienti/{cliente}/nuova_pratica', 'PraticheController@create');
Route::post('/clienti/{cliente}/salva_pratica', 'PraticheController@store');
