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
    Route::post('/data', 'DashboardController@data')->name('data');

    Route::resource('str', STRController::class)->only(['show','store','destroy']);

    Route::resource('sip', SIPController::class)->only(['show','store','destroy']);

    Route::get('/pegawai', 'DataController@pegawai');
    Route::post('/pegawai/data', 'DataController@pegawaiData')->name('pegawai.data');
    Route::put('/pegawai', 'DataController@storeUpdatePegawai')->name('pegawai.update');
    Route::delete('/pegawai/{id}', 'DataController@deletePegawai')->name('pegawai.delete');

    Route::resource('faskes', FaskesController::class)->only(['index','store','update','destroy']);
    Route::resource('profesi', ProfesiController::class)->only(['index','store','update','destroy']);

    Route::get('/t/bio',function(){return view('bio');});
    Route::get('/raw/bio',function(){ return view('raw.bio'); })->name('raw.bio');
});
