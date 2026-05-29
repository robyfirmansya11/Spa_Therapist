<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataSpaController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'login'])
    ->name('login');

Route::post('/login', [AuthController::class, 'authenticate']);

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('users', UserController::class);

    Route::resource('hotels', HotelController::class);

    Route::resource('data-spas', DataSpaController::class);

    Route::resource('transaksi', TransaksiController::class);

    Route::resource('laporan', LaporanController::class);

    Route::get('/laporan/export/excel/{bulan}/{tahun}',
        [LaporanController::class, 'exportExcel']);

    Route::get('/laporan/export/pdf/{bulan}/{tahun}',
        [LaporanController::class, 'exportPdf']);

    Route::get('/laporan', [LaporanController::class, 'index'])
        ->name('laporan.index');

    Route::get('/laporan/create', [LaporanController::class, 'create'])
        ->name('laporan.create');

    Route::get('/laporan/export/excel', [LaporanController::class, 'exportExcel'])
        ->name('laporan.export.excel');

    Route::get('/laporan/export/pdf', [LaporanController::class, 'exportPdf'])
        ->name('laporan.export.pdf');

    Route::post('/logout', [AuthController::class, 'logout']);

});

require __DIR__.'/settings.php';
