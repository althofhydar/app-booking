@extends('layouts.app')

@section('contents')
    <!-- Navigation-->

    <!-- Header-->
 
    <!-- Section-->
    <section class="py-1">
      <div class="container px-4 px-lg-5 mt-5">
        <h3 class="text-center mb-5">Daftar Event</h3>
        <div
          class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center"
        >
        @foreach ($events as $row)
          <div class="col mb-5">
        
            <div class="card h-100">
              <!-- Sale badge-->
              <div
                class="badge badge-custom bg-warning text-white position-absolute"
                style="top: 0; right: 0"
              >
                Tidak Tersedia
              </div>
              <!-- Product image-->
              <img
                class="card-img-top"
                src="{{ asset('storage/' . $row->image) }}"
                alt="{{ $row->event_name }}"
              />
              <!-- Product details-->
              <div class="card-body card-body-custom pt-4">
                <div class="text-center">
                  <!-- Product name-->
                  <h5 class="fw-bolder">VVIP</h5>
                  <!-- Product price-->
                  <div class="rent-price mb-3">
                    <span class="text-primary">Rp.250.000/</span>day
                  </div>
                  <ul class="list-unstyled list-style-group">
                 
                    <li
                      class="border-bottom p-2 d-flex justify-content-between"
                    >
                      <span>Jumlah Kursi</span>
                      <span style="font-weight: 600">10</span>
                    </li>
                  
                  </ul>
                </div>
              </div>
              <!-- Product actions-->
              <div class="card-footer border-top-0 bg-transparent">
                <div class="text-center">
                  <a class="btn btn-primary mt-auto" href="#">Sewa</a>
                  <a
                    class="btn btn-info mt-auto text-white"
                    href="{{ asset ('detail') }}"
                    >Detail</a
                  >
                </div>
              </div>
            </div>
          </div>
          @endforeach
        
            
        </div>
      </div>
     
    </section>
    @endsection

