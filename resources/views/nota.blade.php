<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{config("app.name")}}</title>
  <link href="/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body class="text-center container">
    <div class="my-4">
        <p>Scan kode QR ini untuk melakukan Cekin/Cekout</p>
        {{$result->qr}}
    </div>
    
    <h4>Slot parkir</h4>
    <h1>{{$result->slot->kode_slot}}</h1>
    <p>Tiket ini berlaku untuk {{$result->jenis}} dengan nomor kendaraan (DS) <b>{{$result->ds}}</b> sampai {{$result->batas_waktu}}</p>
    
    <p class="mt-4">made by <b>{{config('app.name')}}</b></p>
</body>