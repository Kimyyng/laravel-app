@extends('template')
@section('content')

<div class="mt-3">
  <p class="mb-0">Selamat datang di</p>
  <h3 class="mt-0">Nusa Putra Parking</h3>
</div>
      <form action="booking" method="post">
        @csrf 
        <div class="d-grid gap-2">
          <h5 class="my-3">Pilih tempat parkir</h5>
          <table class="text-center">
            @foreach ($slot as $item)
            <tr>
              @for ($i = 1; $i <= $item->jumlah; $i++)
              <td>
                <input
                  type="radio"
                  class="btn-check"
                  name="slot"
                  id="{{$item->kode.$i}}"
                  autocomplete="off"
                  value="{{$item->kode.$i}}"
                />
                <label
                  class="btn btn-light btn-outline-dark"
                  for="{{$item->kode.$i}}"
                  >{{$item->kode.$i}}</label
                >
              </td>
              @endfor
            </tr>
            @endforeach
          </table>

          <input class="btn btn-dark mt-5 py-2" type="submit" value="Booking" />
        </div>
      </form>

@endsection 
