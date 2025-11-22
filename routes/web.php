<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\PendaftaranController;

Route::get('/', function () {
    return redirect()->route('peserta.index');
});

Route::resource('peserta', PesertaController::class)->parameters([
    'peserta' => 'peserta'
]);

Route::resource('kelas', KelasController::class)->parameters([
    'kelas' => 'kelas'
]);

Route::resource('pendaftaran', PendaftaranController::class)->except(['show', 'edit', 'update']);
