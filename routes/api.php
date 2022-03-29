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


/** Diputados */
Route::get ('/diputados', 'APIController@getAllDiputados');
Route::get ('/diputado/{id}', 'APIController@getDiputadoById');

/** Votaciones */
Route::get ('/votaciones', 'APIController@getAllVotacionesSummary');
Route::get ('/votaciones/date/{date}', 'APIController@getVotacionesSummaryByDate');
Route::get ('/votaciones/diputado/{id}', 'APIController@getVotacionesSumaryByDiputadoId');
Route::get ('/votacion/{id}', 'APIController@getVotacionDetail');
Route::get ('/votacion/votos/{id}', 'APIController@getVotacionDetailVotos');

/** Intervenciones */
Route::get ('/intervenciones', 'APIController@getAllIntervenciones');
Route::get ('/intervenciones/date/{date}', 'APIController@getIntervencionesByDate');
Route::get ('/intervenciones/diputado/{id}', 'APIController@getIntervencionByDiputadoId');
Route::get ('/intervencion/{id}', 'APIController@getIntervencion');
