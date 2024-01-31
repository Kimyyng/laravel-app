<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Slot;
use App\Models\Waktu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PembayaranController extends Controller
{
    public function create(Request $post)
    {
        //save ke database
        $booking = Booking::create([
            "waktu_id" => $post->input('waktu'),
            "slot_id" => $post->input('kode'),
            "jenis" => $post->input('kendaraan'),
            "ds" => $post->input('ds'),
        ]);

        $total = Waktu::find($post->input('waktu'))->biaya;

        //bayar
        $response = Http::withHeader('content-type', 'application/json')
            ->withBasicAuth(env('XENDIT_API_KEY'), '')
            ->post('https://api.xendit.co/ewallets/charges', [
                "reference_id" => $booking->id,
                "currency" => "IDR",
                "amount" => $total,
                "checkout_method" => "ONE_TIME_PAYMENT",
                "channel_code" => $post->input('metode'),
                "channel_properties" => [
                    "success_redirect_url" => "https://iparking.abiisaleh.xyz/"
                ],
            ]);

        $result = $response->json();

        return redirect()->to($result['action']['smobile_web_checkout_url']);
    }

    public function callback()
    {
        $data = request()->all();

        $id = $data['reference_id'];

        if ($data['status'] == 'SUCCEEDED') {
            $booking = Booking::find($id);
            $booking->lunas = true;
            $booking->save();

            $slot = $booking->slot()->kode_slot;

            return view("pembayaran", [
                "status" => "Success",
                "message" => "Tempat parkir $slot berhasil di booking"
            ]);
        }
    }
}
