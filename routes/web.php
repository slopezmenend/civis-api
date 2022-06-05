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
    return view('dashboard');
});*/

/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');*/

require __DIR__.'/auth.php';
Route::get ('/', 'PagesController@index')->name('index');
Route::get ('/welcome', function () {
    return view('pages.welcome');
});
Route::get ('/dashboard', function () {
    return redirect()->route('index');
});
Route::get ('/eps', function () {
    return view('pages.eps');
});

/** Scripts */
Route::get ('/votaciones/importar/', 'ScriptController@import_votaciones_job')->middleware(['auth'])->name("votaciones.importar");
Route::get ('/diputados/importar/', 'ScriptController@import_diputados_job')->middleware(['auth'])->name('diputados.importar');
Route::get ('/intervenciones/importar/', 'ScriptController@import_intervenciones_job')->middleware(['auth'])->name("intervenciones.importar");
Route::get ('/intervenciones/revisar/', 'ScriptController@importar_intervenciones')->middleware(['auth'])->name("intervenciones.revisar");

/* Recursos principales */
Route::resource('importar-diputados', ResourceControllers\DiputadoImportadoController::class)->except(['store', 'destroy'])->middleware(['auth']);
Route::resource('diputados', ResourceControllers\DiputadoController::class)->except(['store', 'destroy'])->middleware(['auth']);
Route::get('diputados/{diputado}/delete', 'ResourceControllers\DiputadoController@destroy')->name("diputados.destroy")->middleware(['auth']);

Route::resource('votaciones', ResourceControllers\VotacionController::class)->only(['index', 'show'])->middleware(['auth']);
Route::get ('/votaciones/votos/{id}', 'ResourceControllers\VotoController@index')->name('votos.index')->middleware(['auth']);

Route::resource('intervenciones', ResourceControllers\IntervencionController::class)->except(['store', 'destroy'])->middleware(['auth']);

/* Recursos auxiliares */
Route::resource('circunscripciones', ResourceControllers\Auxiliares\CircunscripcionController::class)->middleware(['auth']);
Route::get('circunscripciones/{circunscripcion}/delete', 'ResourceControllers\Auxiliares\CircunscripcionController@destroy')->name("circunscripciones.destroy")->middleware(['auth']);

Route::resource('grupos', ResourceControllers\Auxiliares\GrupoController::class)->except(['destroy'])->middleware(['auth']);
Route::get('grupos/{grupo}/delete', 'ResourceControllers\Auxiliares\GrupoController@destroy')->name("grupos.destroy")->middleware(['auth']);

Route::resource('partidos', ResourceControllers\Auxiliares\PartidoController::class)->except(['destroy'])->middleware(['auth']);
Route::get('partidos/{partido}/delete', 'ResourceControllers\Auxiliares\PartidoController@destroy')->name("partidos.destroy")->middleware(['auth']);

Route::resource('estadosciviles', ResourceControllers\Auxiliares\EstadoCivilController::class)->middleware(['auth']);
Route::get('estadosciviles/{estadocivil}/delete', 'ResourceControllers\Auxiliares\EstadoCivilController@destroy')->name("estadosciviles.destroy")->middleware(['auth']);

Route::resource('sexos', ResourceControllers\Auxiliares\SexoController::class)->middleware(['auth']);
Route::get('sexos/{sexo}/delete', 'ResourceControllers\Auxiliares\SexoController@destroy')->name("estadosciviles.destroy")->middleware(['auth']);


