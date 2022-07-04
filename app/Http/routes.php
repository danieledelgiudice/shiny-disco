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

Route::get('/',                                                                 'PromemoriaController@indexToday');

Route::get( '/clienti',                                                         'ClientiController@index');
Route::get( '/clienti/new',                                                     'ClientiController@create');
Route::get( '/clienti/{cliente}/edit',                                          'ClientiController@edit');
Route::get( '/clienti/{cliente}',                                               'ClientiController@show');
Route::post('/clienti',                                                         'ClientiController@store');
Route::post('/clienti/filter',                                                  'ClientiController@filter');
Route::put( '/clienti/{cliente}',                                               'ClientiController@update');
Route::put( '/clienti/{cliente}/importante',                                    'ClientiController@toggleImportante');
Route::delete( '/clienti/{cliente}',                                            'ClientiController@destroy');



Route::get( '/pratiche',                                                        'PraticheController@index');
Route::get( '/clienti/{cliente}/pratiche/new',                                  'PraticheController@create');
Route::get( '/clienti/{cliente}/pratiche/{pratica}/edit',                       'PraticheController@edit');
Route::get( '/clienti/{cliente}/pratiche/{pratica}',                            'PraticheController@show');
Route::post('/clienti/{cliente}/pratiche',                                      'PraticheController@store');
Route::post('/pratiche/filter',                                                 'PraticheController@filter');
Route::put( '/clienti/{cliente}/pratiche/{pratica}',                            'PraticheController@update');
Route::delete( '/clienti/{cliente}/pratiche/{pratica}',                         'PraticheController@destroy');



Route::get( '/filiali/{filiale}/documenti/new',                                 'DocumentiController@create');
Route::get( '/clienti/{cliente}/pratiche/{pratica}/documenti/{documento}',      'DocumentiController@show');
Route::post('/filiali/{filiale}/documenti',                                     'DocumentiController@store');
Route::delete('/clienti/{cliente}/pratiche/{pratica}/documenti/{documento}',    'DocumentiController@destroy');
Route::delete('/clienti/{cliente}/pratiche/{pratica}/documenti',                'DocumentiController@destroyMultiple');




Route::get( '/login',                                                           'Auth\AuthController@showLoginForm');
Route::get( '/logout',                                                          'Auth\AuthController@logout');
Route::post('/login',                                                           'Auth\AuthController@login');



Route::get( '/clienti/{cliente}/pratiche/{pratica}/pagamenti/new',              'PagamentiController@create');
Route::get( '/clienti/{cliente}/pratiche/{pratica}/pagamenti/{pagamento}/edit', 'PagamentiController@edit');
Route::post('/clienti/{cliente}/pratiche/{pratica}/pagamenti/',                 'PagamentiController@store');
Route::put( '/clienti/{cliente}/pratiche/{pratica}/pagamenti/{pagamento}',      'PagamentiController@update');
Route::delete( '/clienti/{cliente}/pratiche/{pratica}/pagamenti/{pagamento}',   'PagamentiController@destroy');



Route::get( '/clienti/{cliente}/pratiche/{pratica}/assegni/new',                'AssegniController@create');
Route::get( '/clienti/{cliente}/pratiche/{pratica}/assegni/{assegno}/edit',     'AssegniController@edit');
Route::post('/clienti/{cliente}/pratiche/{pratica}/assegni/',                   'AssegniController@store');
Route::put( '/clienti/{cliente}/pratiche/{pratica}/assegni/{assegno}',          'AssegniController@update');
Route::delete( '/clienti/{cliente}/pratiche/{pratica}/assegni/{assegno}',       'AssegniController@destroy');



Route::get( '/clienti/{cliente}/pratiche/{pratica}/prestazioni_mediche/new',                                'PrestazioniMedicheController@create');
Route::get( '/clienti/{cliente}/pratiche/{pratica}/prestazioni_mediche/{prestazione_medica}/edit',          'PrestazioniMedicheController@edit');
Route::post('/clienti/{cliente}/pratiche/{pratica}/prestazioni_mediche/',                                   'PrestazioniMedicheController@store');
Route::put( '/clienti/{cliente}/pratiche/{pratica}/prestazioni_mediche/{prestazione_medica}',               'PrestazioniMedicheController@update');
Route::put( '/clienti/{cliente}/pratiche/{pratica}/prestazioni_mediche/{prestazione_medica}/toggleSospeso', 'PrestazioniMedicheController@toggleSospeso');
Route::delete( '/clienti/{cliente}/pratiche/{pratica}/prestazioni_mediche/{prestazione_medica}',            'PrestazioniMedicheController@destroy');


Route::get( '/filiali/{filiale}/agenda',                                        'PromemoriaController@indexToday');
Route::get( '/filiali/{filiale}/agendaEstesa',                                  'PromemoriaController@indexAll');
Route::post('/agenda/confermaLettura',                                          'PromemoriaController@confermaLettura');
Route::post( '/filiali/{filiale}/agenda/filter',                                'PromemoriaController@filter');
Route::post('/clienti/{cliente}/pratiche/{pratica}/promemoria/new',             'PromemoriaController@store');
Route::put( '/clienti/{cliente}/pratiche/{pratica}/promemoria/{promemoria}',    'PromemoriaController@update');
Route::delete('/clienti/{cliente}/pratiche/{pratica}/promemoria/{promemoria}',  'PromemoriaController@destroy');


Route::get( '/filiali',                                                         'FilialiController@index');
Route::get( '/filiali/new',                                                     'FilialiController@create');
Route::get( '/filiali/{filiale}/edit',                                          'FilialiController@edit');
Route::put( '/filiali/{filiale}/toggleEnabled',                                 'FilialiController@toggleEnabled');
Route::put( '/filiali/{filiale}/toggleCanGenerateLetters',                      'FilialiController@toggleCanGenerateLetters');
Route::put( '/filiali/{filiale}',                                               'FilialiController@update');
Route::post( '/filiali/',                                                       'FilialiController@store');



Route::get( '/filiali/{filiale}/pannello',                                      'PannelloFilialeController@home');
Route::get( '/filiali/{filiale}/pannello/liquidato_omnia',                      'PannelloFilialeController@liquidatoOmnia');
Route::get( '/filiali/{filiale}/pannello/importo_sospeso',                      'PannelloFilialeController@importoSospeso');
Route::get( '/filiali/{filiale}/pannello/parcella_presunta',                    'PannelloFilialeController@parcellaPresunta');
Route::get( '/filiali/{filiale}/pannello/onorari',                              'PannelloFilialeController@onorari');
Route::get( '/filiali/{filiale}/pannello/sospesi_medici',                       'PannelloFilialeController@sospesiMedici');
Route::get( '/filiali/{filiale}/pannello/fatture',                              'PannelloFilialeController@fatture');




Route::get( '/clienti/{cliente}/pratiche/{pratica}/lettere/{lettera}',          'LettereController@show');
Route::get( '/clienti/{cliente}/pratiche/{pratica}/lettere/',                   'LettereController@showOptions');


Route::get( '/clienti/{cliente}/pratiche/{pratica}/fatture/new',                'FattureController@create');
Route::get( '/clienti/{cliente}/pratiche/{pratica}/fatture/{fattura}',          'FattureController@show');
Route::get( '/clienti/{cliente}/pratiche/{pratica}/fatture/{fattura}/edit',     'FattureController@edit');
Route::put( '/clienti/{cliente}/pratiche/{pratica}/fatture/{fattura}',          'FattureController@update');
Route::post('/clienti/{cliente}/pratiche/{pratica}/fatture/',                   'FattureController@store');
Route::delete( '/clienti/{cliente}/pratiche/{pratica}/fatture/{fattura}',       'FattureController@destroy');



Route::get( '/strumenti',                                                       'StrumentiController@index');
Route::get( '/strumenti/export/clienti',                                        'StrumentiController@exportClients');




Route::get( '/clienti/{cliente}/pratiche/{pratica}/condivisioni',               'CondivisioniController@show');
Route::post( '/clienti/{cliente}/pratiche/{pratica}/condivisioni',              'CondivisioniController@store');
Route::delete( '/clienti/{cliente}/pratiche/{pratica}/condivisioni/{filiale}',  'CondivisioniController@destroy');
