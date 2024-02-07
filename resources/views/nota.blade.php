<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{config("app.name")}}</title>

  <style>
    td {
      text-align: center;
      padding: .5rem
    }
  </style>
</head>

<body>
    <table style="border: 1px; border-style:dashed;">
      <tr><td>
        <h4>Slot parkir</h4>
        <h1>{{$result->slot->kode_slot}}</h1>
        Tiket ini berlaku untuk {{$result->jenis}} dengan nomor kendaraan (DS) <b>{{$result->ds}}</b> sampai {{$result->batas_waktu}} <a href="{{route('cari',[$result->id])}}">cek status</a>
      </td></tr>
      <tr><td><img src="data:image/png;base64,{{ base64_encode($result->qr) }}" alt="kode QR Tiket"></td></tr>
      <tr><td>Scan kode QR ini untuk melakukan Cekin/Cekout <br><br></td></tr>
      <tr><td>made by <b>{{config('app.name')}}</b></td></tr>
    </table>
</body>