<?php

use App\Models\Booking;
use App\Models\Slot;
use App\Models\Waktu;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
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
    $data = Slot::groupBy("kode")->select("kode")->get();
    foreach ($data as &$item) {
        $slot[$item->kode] = Slot::where("kode", $item->kode)->get();
    }

    return view('parking', [
        "slot" => $slot,
    ]);
});

Route::post('booking', function (Request $post) {
    if (is_null($post->slot)) {
        Session::flash('message', 'pilih salah satu kolom dibawah ini');
        return redirect()->back();
    }

    return view('booking', [
        "waktu" => Waktu::all(),
        "slot" => Slot::find($post->slot)
    ]);
});

Route::post('pembayaran', function (Request $post) {
    $data = [
        "waktu_id" => $post->waktu,
        "slot_id" => $post->kode,
        "jenis" => $post->kendaraan,
        "ds" => $post->ds,
    ];

    Booking::create($data);

    $slot = Slot::find($post->kode);
    $kode = $slot->kode . $slot->baris;


    return view("pembayaran", [
        "status" => "Success",
        "message" => "Tempat parkir $kode berhasil di booking"
    ]);
});
