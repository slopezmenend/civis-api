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
    Route::post('/register','Auth\ApiAuthController@register')->name('register.api');
    Route::post('/logout', 'Auth\ApiAuthController@logout')->name('logout.api');
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
