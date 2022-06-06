<?php

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

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/', 'DashboardController@index');

    Route::get('/str', 'STRController@index');
    Route::post('/str/data', 'STRController@data')->name('data');

    Route::resource('str', STRController::class)->only(['show','store','update','destroy']);

    // Route::resource('sip', SIPController::class)->only(['show','store','destroy']);

    Route::get('/nakes', 'NakesController@pegawai');
    Route::post('/nakes/data', 'NakesController@pegawaiData')->name('nakes.data');
    Route::put('/nakes', 'NakesController@storeUpdatePegawai')->name('nakes.update');
    Route::delete('/nakes/{id}', 'NakesController@deletePegawai')->name('nakes.delete');

    Route::post('/faskes/data', 'FaskesController@data')->name('faskes.data');
    Route::apiResource('faskes', FaskesController::class)->except('show');
    
    Route::resource('profesi', ProfesiController::class)->only(['index','store','update','destroy']);
    Route::get('getspesialisasi/{id}', 'ProfesiController@getspesialisasi')->name('spesialisasi.get');

    Route::get('/bio', 'BioNakesController@index')->name('bio');

    Route::get('/raw/bio', 'BioNakesController@rawBio')->name('raw.bio');
    Route::get('/raw/historistr', 'BioNakesController@rawHistoristr')->name('raw.historistr');
    Route::get('/raw/historisip', 'BioNakesController@rawHistorisip')->name('raw.historisip');

    Route::get('/data/getspesialisasi/{idprofesi}', 'DataController@getSpesialisasi')->name('data.getspesialisasi');
    
});
