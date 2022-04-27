<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['cors']], function () {
    // public routes
    Route::post('/login', 'Auth\ApiAuthController@login')->name('login.api');
});

/** Diputados */
Route::get ('/diputados', 'APIController@getAllDiputados')->middleware('auth:api');
Route::get ('/diputado/{id}', 'APIController@getDiputadoById')->middleware('auth:api');

/** Votaciones */
Route::get ('/votaciones', 'APIController@getAllVotacionesSummary')->middleware('auth:api');
Route::get ('/votaciones/date/{date}', 'APIController@getVotacionesSummaryByDate')->middleware('auth:api');
Route::get ('/votaciones/diputado/{id}', 'APIController@getVotacionesSumaryByDiputadoId')->middleware('auth:api');
Route::get ('/votacion/{id}', 'APIController@getVotacionDetail')->middleware('auth:api');
Route::get ('/votacion/votos/{id}', 'APIController@getVotacionDetailVotos')->middleware('auth:api');

/** Intervenciones */
Route::get ('/intervenciones', 'APIController@getAllIntervenciones')->middleware('auth:api');
Route::get ('/intervenciones/date/{date}', 'APIController@getIntervencionesByDate')->middleware('auth:api');
Route::get ('/intervenciones/diputado/{id}', 'APIController@getIntervencionByDiputadoId')->middleware('auth:api');
Route::get ('/intervencion/{id}', 'APIController@getIntervencion')->middleware('auth:api');

/** Auxiliares */
Route::get ('/circunscripciones', 'APIController@getCircunscripciones')->middleware('auth:api');
Route::get ('/circunscripcion/{id}', 'APIController@getCircunscripcion')->middleware('auth:api');
Route::get ('/grupos', 'APIController@getGrupos')->middleware('auth:api');
Route::get ('/grupo/{id}', 'APIController@getGrupo')->middleware('auth:api');
Route::get ('/partidos', 'APIController@getPartidos')->middleware('auth:api');
Route::get ('/partido/{id}', 'APIController@getPartido')->middleware('auth:api');
Route::get ('/sexos', 'APIController@getSexos')->middleware('auth:api');
Route::get ('/sexo/{id}', 'APIController@getSexo')->middleware('auth:api');
Route::get ('/estadosciviles', 'APIController@getEstdosCiviles')->middleware('auth:api');
Route::get ('/estadocivil/{id}', 'APIController@getEstadoCivil')->middleware('auth:api');
