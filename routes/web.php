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

    // Route::resource('str', STRController::class)->only(['show','store','destroy']);

    // Route::resource('sip', SIPController::class)->only(['show','store','destroy']);

    Route::get('/nakes', 'DataController@pegawai');
    Route::post('/nakes/data', 'DataController@pegawaiData')->name('nakes.data');
    Route::put('/nakes', 'DataController@storeUpdatePegawai')->name('nakes.update');
    Route::delete('/nakes/{id}', 'DataController@deletePegawai')->name('nakes.delete');

    Route::post('/faskes/data', 'FaskesController@data')->name('faskes.data');
    Route::apiResource('faskes', FaskesController::class)->except('show');
    
    Route::resource('profesi', ProfesiController::class)->only(['index','store','update','destroy']);
    Route::get('getspesialisasi/{id}', 'ProfesiController@getspesialisasi')->name('spesialisasi.get');

    Route::get('/bio',function(){return view('bio');});
    Route::get('/raw/bio',function(){ return view('raw.bio'); })->name('raw.bio');
    Route::get('/raw/historistr',function(){ return view('raw.historistr'); })->name('raw.historistr');
    Route::get('/raw/historisip',function(){ return view('raw.historisip'); })->name('raw.historisip');
    
});
