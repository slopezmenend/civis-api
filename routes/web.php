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

/*Route::get('/', function () {
    return view('welcome');
});

Route::get('/diputados', function () {
    return 'Hola Diputados';
});*/

/*Route::get ('/', 'PagesController@index');
Route::get ('/importar-diputados', 'PagesController@importar_diputados');
Route::get ('/prueba', 'PagesController@diputados');

Route::get ('/diputados', 'DiputadoController@index');
Route::get ('/diputado/{id}', 'DiputadoController@detalle');*/

Route::get ('/', 'PagesController@index');

/** Diputados */
Route::get ('/diputados', 'PagesController@diputado_index');
Route::get ('/diputado/{id}', 'PagesController@diputado_show');
Route::get ('/editar-diputado/{id}', 'PagesController@diputado_edit');
Route::put ('/update-diputado/{id}', 'PagesController@diputado_update');



/** Votaciones */
Route::get ('/votaciones', 'PagesController@votacion_index');
Route::get ('/votaciones/date/{date}', 'PagesController@getVotacionesSummaryByDate');
Route::get ('/votaciones/diputado/{id}', 'PagesController@getVotacionesSumaryByDiputadoId');
Route::get ('/votacion/{id}', 'PagesController@votacion_show');
Route::get ('/votacion/votos/{id}', 'PagesController@voto_index');

/** Intervenciones */
Route::get ('/intervenciones', 'PagesController@getAllIntervenciones');
Route::get ('/intervenciones/date/{date}', 'PagesController@getIntervencionesByDate');
Route::get ('/intervenciones/diputado/{id}', 'PagesController@getIntervencionByDiputadoId');
Route::get ('/intervencion/{id}', 'PagesController@getIntervencion');

/** Scripts */
Route::get ('/votaciones/importar/', 'ScriptController@importar_votaciones');
Route::get ('/diputados/importar/', 'ScriptController@importar_diputados');

