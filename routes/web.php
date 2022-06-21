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

    Route::resource('sip', SIPController::class)->only(['show','store','update','destroy']);

    Route::get('/nakes', 'NakesController@pegawai');
    Route::post('/nakes/data', 'NakesController@pegawaiData')->name('nakes.data');
    Route::post('/nakes', 'NakesController@storePegawai')->name('nakes.store');
    Route::put('/nakes', 'NakesController@updatePegawai')->name('nakes.update');
    Route::delete('/nakes/{id}', 'NakesController@deletePegawai')->name('nakes.delete');

    Route::post('/faskes/data', 'FaskesController@data')->name('faskes.data');
    Route::apiResource('faskes', FaskesController::class)->except('show');
    Route::get('getpegawai/{id}', 'FaskesController@getpegawai')->name('pegawai.get');
    
    Route::resource('profesi', ProfesiController::class)->only(['index','store','update','destroy']);
    Route::get('getspesialisasi/{id}', 'ProfesiController@getspesialisasi')->name('spesialisasi.get');
    Route::put('putspesialisasi/{id}', 'ProfesiController@updateSpesialisasi')->name('spesialisasi.update');
    Route::post('storespesialisasi', 'ProfesiController@storeSpesialisasi')->name('spesialisasi.store');
    Route::delete('destroypesialisasi/{id}', 'ProfesiController@destroySpesialisasi')->name('spesialisasi.destroy');

    Route::get('/bio', 'BioNakesController@index')->name('bio');

    Route::get('/raw/bio', 'BioNakesController@rawBio')->name('raw.bio');
    Route::get('/raw/historistr', 'BioNakesController@rawHistoristr')->name('raw.historistr');
    Route::get('/raw/historisip', 'BioNakesController@rawHistorisip')->name('raw.historisip');

    Route::get('/data/getspesialisasi/{idprofesi}', 'DataController@getSpesialisasi')->name('data.getspesialisasi');
    Route::get('/data/searchfaskes', 'DataController@searchFaskes')->name('data.searchfaskes');
    Route::get('/data/searchpegawai', 'DataController@searchPegawai')->name('data.searchpegawai');

    Route::get('/cetak/perstek/{idsip}', 'CetakController@perstek')->name('cetak.perstek');
    Route::get('/cetak/kitir/{idsip}', 'CetakController@kitir')->name('cetak.kitir');
    Route::get('/cetak/sip/{idsip}', 'CetakController@sip')->name('cetak.sip');
    
});
