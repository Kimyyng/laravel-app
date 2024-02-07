<?php

use App\Http\Controllers\ParkingController;
use App\Http\Controllers\PembayaranController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ParkingController::class, 'index']);
Route::get('parking', [ParkingController::class, 'parking'])->name('slot');
Route::post('booking', [ParkingController::class, 'booking']);
Route::get('scan/{jenis}', [ParkingController::class, 'scan'])->name('scan');
Route::get('cari/{id}', [ParkingController::class, 'find'])->name('cari');
Route::get('pdf/{id}', [ParkingController::class, 'print'])->name('pdf');

Route::prefix('pembayaran')->group(function () {
    Route::post('/', [PembayaranController::class, 'create']);
    Route::post('/cek', [PembayaranController::class, 'callback']);
});

Route::prefix('api')->group(function () {
    Route::get('/cekin/{id}', [ParkingController::class, 'cekin'])->name('api.cekin');
    Route::get('/cekout/{id}', [ParkingController::class, 'cekout'])->name('api.cekout');
})->middleware([Authenticate::class]);
