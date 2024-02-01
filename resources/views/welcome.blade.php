@extends("_simple")

@section("content")
        <h6>{{config("app.name")}}</h6>

        <img 
          src="/img/logo.webp" 
          class="mx-auto" 
          alt="mobil parkir" 
          style="filter: invert(100%); max-width: 250px; margin: 100px 0;"
        >

        <h3>Booking Parkir</h3>
        <p class="mb-5">booking tempat parkir langsung dari hp anda</p>
      
        <div class="d-grid gap-2 mt-4">
          <a href="parking" class="btn btn-light">Get Started</a>
          <a href="admin" class="btn btn-outline-light">Scan QR Code</a>
          <a href="admin" class="text-warning d-block">Login as admin</a>
        </div>
@endSection