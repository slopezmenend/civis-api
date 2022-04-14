<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ResourceControllers\DiputadoImportadoController;

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
Route::get ('/prueba', 'PagesController@diputados');*/

Route::get ('/', 'PagesController@index');

/** Scripts */
Route::get ('/votaciones/importar/', 'ScriptController@import_votaciones_job')->name("votaciones.importar");
Route::get ('/diputados/importar/', 'ScriptController@import_diputados_job')->name('diputados.importar');
//Route::get ('/diputados/revisar/', 'ScriptController@importar_diputados')->name("diputados.revisar");
//Route::get ('/diputados/importarhtml/', 'ScriptController@importar_diputados_html')->name("diputados.importarhtml");
Route::get ('/intervenciones/importar/', 'ScriptController@import_intervenciones_job')->name("intervenciones.importar");
//Route::get ('/intervenciones/importar/', 'ScriptController@test')->name("intervenciones.importar");
Route::get ('/intervenciones/revisar/', 'ScriptController@importar_intervenciones')->name("intervenciones.revisar");

/* Recursos principales */
Route::resource('importar-diputados', ResourceControllers\DiputadoImportadoController::class)->except(['store', 'destroy']);
Route::resource('diputados', ResourceControllers\DiputadoController::class)->except(['store', 'destroy']);
Route::get('diputados/{diputado}/delete', 'ResourceControllers\DiputadoController@destroy')->name("diputados.destroy");
//Route::post('diputados/{diputado}', 'ResourceControllers\DiputadoController@update')->name("diputados.update");
//Route::resource('review/diputados/', ResourceControllers\DiputadoImportadoController::class)->except(['store', 'destroy']);
/*Route::get('diputado/review/{id}', 'ResourceControllers\DiputadoImportadoController@show')->name('diputados.review.show');
Route::get('diputado/review/edit/{id}', 'ResourceControllers\DiputadoImportadoController@edit')->name('diputados.review.edit');
Route::post('diputado/review/edit/{id}', 'ResourceControllers\DiputadoImportadoController@update')->name('diputados.review.update');
Route::get('diputados/review', 'ResourceControllers\DiputadoImportadoController@index')->name('diputados.review.index');
Route::resource('review/diputados/', ResourceControllers\DiputadoImportadoController::class)->except(['store', 'destroy']);*/
//Route::get ('diputados/revisar', 'ResourceControllers\DiputadoController@index')->name('diputados.revisar');

Route::resource('votaciones', ResourceControllers\VotacionController::class)->only(['index', 'show']);
Route::get ('/votaciones/votos/{id}', 'ResourceControllers\VotoController@index')->name('votos.index');

Route::resource('intervenciones', ResourceControllers\IntervencionController::class)->except(['store', 'destroy']);

/* Recursos auxiliares */
Route::resource('circunscripciones', ResourceControllers\Auxiliares\CircunscripcionController::class);
Route::get('circunscripciones/{circunscripcion}/delete', 'ResourceControllers\Auxiliares\CircunscripcionController@destroy')->name("circunscripciones.destroy");

Route::resource('grupos', ResourceControllers\Auxiliares\GrupoController::class)->except(['destroy']);
Route::get('grupos/{grupo}/delete', 'ResourceControllers\Auxiliares\GrupoController@destroy')->name("grupos.destroy");

Route::resource('partidos', ResourceControllers\Auxiliares\PartidoController::class)->except(['destroy']);
Route::get('partidos/{partido}/delete', 'ResourceControllers\Auxiliares\PartidoController@destroy')->name("partidos.destroy");

Route::resource('estadosciviles', ResourceControllers\Auxiliares\EstadoCivilController::class);
Route::get('estadosciviles/{estadocivil}/delete', 'ResourceControllers\Auxiliares\EstadoCivilController@destroy')->name("estadosciviles.destroy");

Route::resource('sexos', ResourceControllers\Auxiliares\SexoController::class);
Route::get('sexos/{sexo}/delete', 'ResourceControllers\Auxiliares\SexoController@destroy')->name("estadosciviles.destroy");

Route::get('login', 'PagesController@login');
Route::get('signup', 'PagesController@signup');
Route::post('signup/confirmation', 'PagesController@signupConfirmation')->name("signup.confirmation");
/** Diputados */
/*Route::get ('/diputados', 'DiputadoController@index');
Route::get ('/diputado/{id}', 'DiputadoController@show');
Route::get ('/editar-diputado/{id}', 'DiputadoController@edit');
Route::put ('/update-diputado/{id}', 'DiputadoController@update');
Route::resource('search', 'DiputadoController@search');*/

/** Votaciones */
/*Route::get ('/votaciones', 'PagesController@votacion_index');
Route::get ('/votaciones/date/{date}', 'PagesController@getVotacionesSummaryByDate');
Route::get ('/votaciones/diputado/{id}', 'PagesController@getVotacionesSumaryByDiputadoId');
Route::get ('/votacion/{id}', 'PagesController@votacion_show');
Route::get ('/votacion/votos/{id}', 'PagesController@voto_index');*/

/** Intervenciones */
/*Route::get ('/intervenciones', 'PagesController@getAllIntervenciones');
Route::get ('/intervenciones/date/{date}', 'PagesController@getIntervencionesByDate');
Route::get ('/intervenciones/diputado/{id}', 'PagesController@getIntervencionByDiputadoId');
Route::get ('/intervencion/{id}', 'PagesController@getIntervencion');*/



