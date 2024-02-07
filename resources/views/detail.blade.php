@extends("_simple")

@section("content")

<img src="data:image/png;base64,{{ base64_encode($result->qr) }}" alt="kode QR Tiket">

@if ($result->lunas)
    @if ($result->selesai)
        <h1 class="text-danger">Expired</h1>
        <p>Masa berlaku sudah habis</p>
    @else
        <h1 class="text-success">Lunas</h1>
        <p>Unduh bukti pembayaran <a href="{{route('pdf',[$result->id])}}" class="text-success">disini</a></p>
    @endif    
@else
    <h1 class="text-warning">Pending</h1>
    <p>Harap segera melakukan pembayaran <a href="{{$result->payment_link}}" class="text-warning">disini</a></p>
@endif

<table class="text-start table table-dark">
    <tr>
        <td>Nomor kendaraan</td>
        <td>:</td>
        <td>{{$result->ds}}</td>
    </tr>
    <tr>
        <td>Jenis kendaraan</td>
        <td>:</td>
        <td>{{$result->jenis}}</td>
    </tr>
    <tr>
        <td>Kode parkir</td>
        <td>:</td>
        <td>{{$result->slot->kode_slot}}</td>
    </tr>
    <tr>
        <td>Durasi</td>
        <td>:</td>
        <td>{{$result->waktu->durasi}} Jam</td>
    </tr>
    <tr>
        <td>Tanggal booking</td>
        <td>:</td>
        <td>{{$result->created_at}}</td>
    </tr>
    <tr>
        <td>Tanggal berakhir</td>
        <td>:</td>
        <td>{{$result->batas_waktu}}</td>
    </tr>

    @if ($result->waktu_tambahan)
    <tr>
        <td>Tambahan waktu</td>
        <td>:</td>
        <td>{{$result->waktu_tambahan}} Jam</td>
    </tr>
    <tr>
        <td>Tambahan biaya</td>
        <td>:</td>
        <td>Rp. {{ number_format($result->denda)}}</td>
    </tr>
    @else
    <tr>
        <td>Sisa waktu</td>
        <td>:</td>
        <td>{{$result->sisaWaktu}}</td>
    </tr>
    @endif
</table>

@endsection
