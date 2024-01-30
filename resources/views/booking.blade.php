@extends('_default')
@section('content')

<div class="mt-3">
  <p class="mb-0">Kode Parkir</p>
  <h3 class="mt-0">{{$slot->kode.$slot->baris}}</h3>
</div>
      <form action="pembayaran" method="POST">
        @csrf 
        <input type="hidden" name="kode" value="{{$slot->id}}">

        <div class="d-grid gap-2">
          <div>
            <h6 class="my-3">Nomor Kendaraan (DS)</h6>
            <input name="ds"  type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="PA xxxx xx">
          </div>

          <div>
            <h6 class="my-3">Waktu Parkir</h6>
            <div class="row">
              @foreach ($waktu as $item)
              <div class="col-4 d-grid">
                <input
                  type="radio"
                  class="btn-check"
                  name="waktu"
                  value="{{$item->id}}"
                  id="{{$item->id}}"
                  autocomplete="off"
                />
                <label class="btn btn-light btn-outline-dark" for="{{$item->id}}">
                  <p class="mb-0 fw-bold text-right">{{$item->durasi}} Jam</p>
                  <p>Rp. {{number_format($item->biaya)}}<p>
                </label>
              </div>
                  
              @endforeach

            </div>
          </div>
          <div>
            <h6 class="my-3">Jenis Kendaraan</h6>
            <div class="row">
              <div class="col-4 d-grid">
                <input
                  type="radio"
                  class="btn-check"
                  name="kendaraan"
                  id="option1b"
                  value="motor"
                  autocomplete="off"
                />
                <label class="btn btn-light btn-outline-dark" for="option1b">
                  <p class="mb-0 fw-bold text-right">Motor</p>
                  <p>Roda 2</p>
                </label>
              </div>

              <div class="col-4 d-grid">
                <input
                  type="radio"
                  class="btn-check"
                  name="kendaraan"
                  id="option2b"
                  value="mobil"
                  autocomplete="off"
                  checked
                />
                <label class="btn btn-light btn-outline-dark" for="option2b">
                  <p class="mb-0 fw-bold">Mobil</p>
                  <p>Roda 4</p>
                </label>
              </div>

              <div class="col-4 d-grid">
                <input
                  type="radio"
                  class="btn-check"
                  name="kendaraan"
                  id="option3b"
                  value="truk"
                  autocomplete="off"
                />
                <label class="btn btn-light btn-outline-dark" for="option3b">
                  <p class="mb-0 fw-bold">Truk</p>
                  <p>Roda ≥ 4</p>
                </label>
              </div>
            </div>
          </div>
          <input
            class="btn btn-dark mt-5 py-2"
            type="submit"
            value="Konfirmasi Booking"
          />
        </div>
      </form>
    @endsection 