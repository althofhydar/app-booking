@extends('layouts.app')

@section('contents')
<!-- Navigation-->

<!-- Header-->

<!-- Section-->
<section class="py-1">
  <div class="container px-4 px-lg-5 mt-1">
    <h3 class="text-center mb-5">Daftar Event</h3>
    <div class="mb-3">
      
      <input type="text" id="search" placeholder="Search Event..." class="form-control" oninput="liveSearch()">
    </div>
    <div id="cardContainer" class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-left">
      @foreach ($acakevent as $event)
        <div class="col mb-5">
          <div class="card h-100">
            <img class="card-img-top" src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->event_name }}" style="height: 180px; object-fit: cover;">
            <div class="card-body pt-2">
              <div class="text-center">
                <h5 class="fw-bolder">{{ $event->event_name }}</h5>
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
            <div class="text-center">
              <a class="btn btn-primary mt-auto" href="{{ route('detail', $event->id) }}">Detail</a>
            </div>
            <div class="card-footer border-top-0 bg-transparent"  style="height: 15px;">
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search');
    searchInput.addEventListener('input', liveSearch);

    window.eventData = {!! json_encode($acakevent) !!}; // Passing events data to JavaScript
    window.detailRoute = "{{ url('detail') }}";
  });

  function liveSearch() {
    const searchInput = document.getElementById('search');
    const searchTerm = searchInput.value.toLowerCase();
    const cardContainer = document.getElementById('cardContainer');

    // Filter events based on the search term
    const filteredResults = eventData.filter(event =>
      event.event_name.toLowerCase().includes(searchTerm) ||
      event.event_date.toLowerCase().includes(searchTerm) ||
      event.start_time.toLowerCase().includes(searchTerm) ||
      event.end_time.toLowerCase().includes(searchTerm)
    );

    // Display search results
    if (filteredResults.length > 0) {
      cardContainer.innerHTML = ''; // Clear existing card container

      filteredResults.forEach(event => {
        const cardItem = document.createElement('div');
        cardItem.classList.add('col', 'mb-5');
        cardItem.innerHTML = `
     
          <div class="card h-100">
            <img class="card-img-top" src="{{ asset('storage/') }}/${event.image}" alt="${event.event_name}" style="height: 200px; object-fit: cover;">
            <div class="card-body pt-2">
              <div class="text-center">
                <h5 class="fw-bolder">${event.event_name}</h5>
                <ul class="list-unstyled list-style-group">
                  <li class="border-bottom p-2 d-flex justify-content-between">
                    <span>Date</span>
                    <span style="font-weight: 600">${event.event_date}</span>
                  </li>
                  <li class="border-bottom p-2 d-flex justify-content-between">
                    <span>Start</span>
                    <span style="font-weight: 600">${event.start_time}</span>
                  </li>
                  <li class="border-bottom p-2 d-flex justify-content-between">
                    <span>End</span>
                    <span style="font-weight: 600">${event.end_time}</span>
                  </li>
                </ul>
              </div>
            </div>
            <div class="text-center">
                <a class="btn btn-primary mt-auto" href="${detailRoute}/${event.id}">Detail</a>
              </div>
            <div class="card-footer border-top-0 bg-transparent">
            </div>  
          </div>
 
        `;
        cardContainer.appendChild(cardItem);
      });
    } else {
      cardContainer.innerHTML = '<div class="col"><div class="card"><div class="card-body"><h5 class="card-title">No events found</h5></div></div></div>';
    }
  }
</script>
@endsection
