@extends('layouts.app')

@section('contents')
<!-- Navigation-->

<!-- Header-->
<form method="GET" action="{{ route('events.search') }}">
  <div class="input-group mb-3">
    <input type="text" name="query" class="form-control" placeholder="Search events..." aria-label="Search events" aria-describedby="button-addon2">
    <button class="btn btn-primary" type="submit" id="button-addon2">Search</button>
  </div>
</form>
<!-- Section-->
<section class="py-1">
  <div class="container px-1 px-lg-1 mt-1">
    <h3 class="text-center mb-5">Daftar Event</h3>
    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-left">
      @foreach ($events as $event)
      
          <div class="col mb-5">
            <div class="card h-100">
              <!-- Sale badge-->
              <div class="badge badge-custom bg-warning text-white position-absolute" style="top: 0; right: 0">
                Tidak Tersedia
              </div>
              <!-- Product image-->
              <img class="card-img-top" src="{{ asset('storage/' . $event->image) }}"  style="height: 200px";
              width="500px";  alt="{{ $event->event_name }}" />
              <!-- Product details-->
              <div class="card-body card-body-custom pt-2"  style="height: 175px";
              width="500px"; >
                <div class="text-center">
                  <!-- Product name-->
                  <h5 class="fw-bolder">{{ $event->event_name }}</h5>
                  <!-- Product price-->
                
                  <ul class="list-unstyled list-style-group">
                
                 
                    <li class="border-bottom p-2 d-flex justify-content-between">
                      <span>Date</span>
                      <span style="font-weight: 600">{{ $event->event_date }}</span>
                    </li>
                    <li class="border-bottom p-2 d-flex justify-content-between">
                      <span>Start</span>
                      <span style="font-weight: 600">{{ $event->start_time }}</span>
                    </li>
                    <li class="border-bottom p-2 d-flex justify-content-between">
                      <span>End</span>
                      <span style="font-weight: 600">{{ $event->end_time }}</span>
                    </li>

                  </ul>
                </div>
              </div>

              <!-- Product actions-->
              <div class="card-footer border-top-0 bg-transparent">
                <div class="text-center">
                 
                  <a class="btn d-flex align-items-center justify-content-center btn-primary mt-auto" href="{{ route('detail', $event->id) }}">Detail</a>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      
    </div>
  </div>
</section>
@endsection
