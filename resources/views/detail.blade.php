@extends("_simple")

@section("content")

<div class="my-4">
    {{QrCode::size(150)->color(255, 255, 255)->backgroundColor(33, 37, 41)->generate($booking->kode_booking)}}
</div>

@if ($booking->lunas)
<h1 class="text-success">Lunas</h1>
<p>Pembayaran berhasil dilakukan</p>
@else
<h1 class="text-warning">Pending</h1>
<p>Harap segera melakukan pembayaran <a href="{{$booking->payment_link}}" class="text-warning">disini</a></p>
@endif

<table class="text-start table table-dark">
    <tr>
        <td>Nomor Kendaraan</td>
        <td>:</td>
        <td>{{$booking->ds}}</td>
    </tr>
    <tr>
        <td>Jenis Kendaraan</td>
        <td>:</td>
        <td>{{$booking->jenis}}</td>
    </tr>
    <tr>
        <td>Kode Parkir</td>
        <td>:</td>
        <td>{{$booking->slot->kode_slot}}</td>
    </tr>
    <tr>
        <td>Durasi</td>
        <td>:</td>
        <td>{{$booking->waktu->durasi}} Jam</td>
    </tr>
    <tr>
        <td>Tambahan biaya</td>
        <td>:</td>
        <td>Rp. {{ number_format($booking->denda)}}</td>
    </tr>
</table>

<a href="http://127.0.0.1:8000/parking" class="btn btn-light btn-outline-dark">
    <p class="mb-0 fw-bold">Back</p>
</a>
    
@endsection
