<?php

use App\Models\booking;
use App\Models\slot;
use App\Models\waktu;
use Illuminate\Database\Eloquent\Model;
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
    $data = slot::groupBy("kode")->select("kode")->get();
    foreach ($data as &$item) {
        $slot[$item->kode] = slot::where("kode", $item->kode)->get();
    }

    return view('parking', [
        "slot" => $slot,
    ]);
});

Route::post('booking', function (Request $post) {
    return view('booking', [
        "waktu" => waktu::all(),
        "slot" => slot::find($post->slot)
    ]);
});

Route::post('pembayaran', function (Request $post) {
    $data = [
        "waktu_id" => $post->waktu,
        "slot_id" => $post->kode,
        "jenis" => $post->kendaraan,
        "ds" => $post->ds,
    ];

    booking::create($data);

    $slot = slot::find($post->kode);
    $kode = $slot->kode . $slot->baris;


    return view("pembayaran", [
        "status" => "Success",
        "message" => "Tempat parkir $kode berhasil di booking"
    ]);
});
