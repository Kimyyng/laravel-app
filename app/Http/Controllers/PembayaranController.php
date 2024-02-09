<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Slot;
use App\Models\Waktu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class PembayaranController extends Controller
{
    public function create(Request $post)
    {
        //cek apakah slot sudah diambil
        $cek = Booking::where('slot_id', $post->input('kode'))->where('lunas', true)->where('cekout', !null)->get()->isNotEmpty();
        $slot = Slot::find($post->input('kode'));

        if ($cek) {
            Session::flash('message', 'slot' . $slot->kode_slot . ' sudah dibooking. pilih yang slot yang lain');
            return redirect()->to('parking');
        }

        //save ke database
        $booking = Booking::create([
            "waktu_id" => $post->input('waktu'),
            "slot_id" => $post->input('kode'),
            "jenis" => $post->input('kendaraan'),
            "ds" => $post->input('ds'),
            "pembayaran" => $post->input('metode'),
        ]);

        $total = Waktu::find($post->input('waktu'))->biaya;
        $success_url = route('cari', [$booking->id]);

        if ($post->input('metode') == 'CASH') {
            $booking->save();
            return redirect()->to($success_url);
        }

        //bayar
        $response = Http::withHeader('content-type', 'application/json')
            ->withBasicAuth(env('XENDIT_API_KEY'), '')
            ->post('https://api.xendit.co/ewallets/charges', [
                "reference_id" => "$booking->id",
                "currency" => "IDR",
                "amount" => $total,
                "checkout_method" => "ONE_TIME_PAYMENT",
                "channel_code" => $post->input('metode'),
                "channel_properties" => [
                    "success_redirect_url" => "$success_url"
                ],
            ]);

        $result = $response->json();
        $payment_link = $result['actions']['mobile_web_checkout_url'];

        $booking->payment_link = $payment_link;
        $booking->save();

        return redirect()->to($payment_link);
    }

    public function callback()
    {
        $data = request()->all()['data'];
        $id = $data['reference_id'];

        if ($data['status'] == 'SUCCEEDED') {
            $booking = Booking::find($id);

            if (is_null($booking)) {
                return response('Data tidak ditemukan')->json();
            }

            $booking->lunas = 1;
            $booking->save();

            return response('Status berhasil diubah')->json();
        }

        return response('Gagal...')->json();
    }
}
