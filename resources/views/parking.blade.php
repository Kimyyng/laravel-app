@extends('_default')
@section('content')

      <div class="mt-4 d-flex justify-content-between align-items-center">
<div>
        <p class="mb-0">Parking area</p>
        <h3 class="mt-0">Universitas Nusa Putra</h3>
</div>
<div class="shadow-sm p-3 rounded-circle" style={aspect-ratio: 1;}>
<i class="bi bi-arrow-left"></i>
</div>
      </div>
      <form action="booking" method="post">
        @csrf 
        <div class="d-grid gap-2 my-2">
          <img class="mx-auto img-fluid" src="img/area.jpg" alt="tempat parkir">
          <h5 class="my-3">Pilih tempat parkir</h5>
          @if (!is_null(Session::get('message')))
              <div class="alert alert-secondary" role="alert">
                {{Session::get('message')}}
              </div>
          @endif
          <table class="text-center">
            @foreach ($slot as $kode)
            <tr>
              @foreach ($kode as $item)
              <td>
                <input
                  type="radio"
                  class="btn-check"
                  name="slot"
                  id="{{$item->id}}"
                  autocomplete="off"
                  value="{{$item->id}}"
                  {{ ($item->used || !$item->active) ? "disabled" : "" }}
                />
                <label
                  class="btn  {{ $item->used ? "btn-dark text-white" : "btn-light btn-outline-dark" }}"
                  for="{{$item->id}}"
                  >{{$item->kode.$item->baris}}</label
                >
              </td>
              @endforeach
            </tr>
            @endforeach
          </table>

          <input class="btn btn-dark mt-5 py-2" type="submit" value="Booking" />
        </div>
      </form>

@endsection 
