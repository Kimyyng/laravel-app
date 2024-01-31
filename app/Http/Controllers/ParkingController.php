<?php

namespace App\Http\Controllers;

use App\Models\Slot;
use App\Models\Waktu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
}
