<?php

use App\Http\Controllers\ParkingController;
use App\Http\Controllers\PembayaranController;
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
Route::get('parking', [ParkingController::class, 'parking']);
Route::post('booking', [ParkingController::class, 'booking']);

Route::prefix('pembayaran')->group(function () {
    Route::post('/', [PembayaranController::class, 'create']);
    Route::post('/cek', [ParkingController::class, 'callback']);
});
