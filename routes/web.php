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

    Route::resource('str', STRController::class)->only(['index','store','destroy']);

    Route::resource('sip', STRController::class)->only(['index','store','destroy']);

    Route::get('/pegawai', 'DataController@pegawai');
    Route::post('/pegawai/data', 'DataController@pegawaiData')->name('pegawai.data');
    Route::put('/pegawai', 'DataController@storeUpdatePegawai')->name('pegawai.update');
    Route::delete('/pegawai', 'DataController@delete')->name('pegawai.delete');
});
