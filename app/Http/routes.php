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

Route::get( '/clienti',                                                 'ClientiController@index');
Route::get( '/clienti/new',                                             'ClientiController@create');
Route::get( '/clienti/{cliente}/edit',                                  'ClientiController@edit');
Route::get( '/clienti/{cliente}',                                       'ClientiController@show');
Route::post('/clienti',                                                 'ClientiController@store');
Route::post('/clienti/filter',                                          'ClientiController@filter');
Route::put( '/clienti/{cliente}',                                       'ClientiController@update');



Route::get( '/pratiche',                                                'PraticheController@indexAll');
Route::get( '/clienti/{cliente}/pratiche/new',                          'PraticheController@create');
Route::get( '/clienti/{cliente}/pratiche/{pratica}/edit',               'PraticheController@edit');
Route::get( '/clienti/{cliente}/pratiche/{pratica}',                    'PraticheController@show');
Route::post('/clienti/{cliente}/pratiche',                              'PraticheController@store');
Route::put( '/clienti/{cliente}/pratiche/{pratica}',                    'PraticheController@update');
