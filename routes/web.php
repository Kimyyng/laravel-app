<?php

use App\Models\slot;
use App\Models\waktu;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Request;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('parking', function () {
    return view('parking',[
        "slot" => slot::all(),
    ]);

});

Route::post('booking', function (Request $post) {
    return view('booking',[
        "waktu" => waktu::all(),
        "kode" => $post->slot
    ]);
});

Route::post('pembayaran',function (Request $post) {
    $data=[
        "waktu"=> $post->waktu,
        "kode"=> $post->kode,
        "jenis"=> $post->kendaraan,
        "ds"=> $post->ds,
    ];
    var_dump($data);

});
