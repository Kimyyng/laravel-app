<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Slot;
use App\Models\Waktu;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ParkingController extends Controller
{

    public function index()
    {
        return view('welcome');
    }

    public function parking()
    {
        $data = Slot::groupBy("kode")->select("kode")->get();
        foreach ($data as &$item) {
            $slot[$item->kode] = Slot::where("kode", $item->kode)->get();
        }

        return view('parking', [
            "slot" => $slot,
        ]);
    }

    public function booking(Request $post)
    {
        if (is_null($post->input('slot'))) {
            Session::flash('message', 'pilih salah satu kolom dibawah ini');
            return redirect()->back();
        }

        return view('booking', [
            "waktu" => Waktu::all(),
            "slot" => Slot::find($post->input('slot'))
        ]);
    }

    public function scan($jenis)
    {
        return view('scan', [
            'jenis' => 'api.' . $jenis
        ]);
    }

    public function find($id)
    {
        $booking = Booking::find($id);

        return view('detail', [
            'result' => $booking,
        ]);
    }

    public function print($id)
    {
        $booking = Booking::find($id);

        $pdf = Pdf::loadView('nota', ['result' => $booking])->setPaper('a6', 'potratit');
        return $pdf->download('Tiket ' . config('app.name') . '-' . $booking->id . '.pdf');
    }

    public function cekin($id)
    {
        $booking = Booking::find($id);

        if (!$booking)
            return response([
                'msg' => 'Data tidak ditemukan',
                'success' => false
            ]);

        if (!$booking->lunas)
            return response([
                'msg' => 'Belum lunas',
                'success' => false
            ]);

        if (now() > $booking->batas_waktu)
            return response([
                'msg' => 'Tiket Expired',
                'success' => false
            ]);

        if ($booking->cekin)
            return response([
                'msg' => 'Sudah Cekin ' . $booking->cekin->diffForHumans(),
                'success' => false,
                'tanggal' => $booking->cekin
            ]);

        $booking->cekin = now();
        $booking->save();
        return response([
            'msg' => 'Berhasil Cekin',
            'success' => true
        ]);
    }

    public function cekout($id)
    {
        $booking = Booking::find($id);

        if (!$booking)
            return response([
                'msg' => 'Data tidak ditemukan',
                'success' => false
            ]);
        if ($booking->cekout)
            return response([
                'msg' => 'Sudah Cekout ' . $booking->cekout->diffForHumans(),
                'success' => false,
                'tanggal' => $booking->cekout
            ]);

        $booking->cekout = now();
        $booking->save();
        return response([
            'msg' => 'Berhasil Cekout',
            'success' => true,
            'denda' => $booking->denda
        ]);
    }
}
