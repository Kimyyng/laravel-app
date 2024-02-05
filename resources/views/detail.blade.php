@extends("_default")

@section("content")

@if ($booking->lunas)
    @if ($booking->selesai)
        <h1 class="text-danger">Expired</h1>
        <p>Masa berlaku sudah habis</p>
    @else
        <h1 class="text-success">Lunas</h1>
        <p>Unduh bukti pembayaran <a href="{{route('pdf',[$booking->id])}}" class="text-success">disini</a></p>
    @endif    
@else
    <h1 class="text-warning">Pending</h1>
    <p>Harap segera melakukan pembayaran <a href="{{$booking->payment_link}}" class="text-warning">disini</a></p>
@endif

<table class="text-start table table-dark">
    <tr>
        <td>Nomor kendaraan</td>
        <td>:</td>
        <td>{{$booking->ds}}</td>
    </tr>
    <tr>
        <td>Jenis kendaraan</td>
        <td>:</td>
        <td>{{$booking->jenis}}</td>
    </tr>
    <tr>
        <td>Kode parkir</td>
        <td>:</td>
        <td>{{$booking->slot->kode_slot}}</td>
    </tr>
    <tr>
        <td>Durasi</td>
        <td>:</td>
        <td>{{$booking->waktu->durasi}} Jam</td>
    </tr>
    <tr>
        <td>Tanggal booking</td>
        <td>:</td>
        <td>{{$booking->created_at}}</td>
    </tr>
    <tr>
        <td>Tanggal berakhir</td>
        <td>:</td>
        <td>{{$booking->batas_waktu}}</td>
    </tr>

    @if ($booking->waktu_tambahan)
    <tr>
        <td>Tambahan waktu</td>
        <td>:</td>
        <td>{{$booking->waktu_tambahan}} Jam</td>
    </tr>
    <tr>
        <td>Tambahan biaya</td>
        <td>:</td>
        <td>Rp. {{ number_format($booking->denda)}}</td>
    </tr>
    @else
    <tr>
        <td>Sisa waktu</td>
        <td>:</td>
        <td>{{$booking->sisaWaktu}}</td>
    </tr>
    @endif
</table>

@endsection
