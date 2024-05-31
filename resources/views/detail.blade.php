@extends('layouts.app')

@section('contents')
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row justify-content-center">
          @foreach ($tickets as $ticket)
            <div class="col-lg-8 mb-5">
                <div class="card h-100">
                    <!-- Product image-->
                    <img class="card-img-top" src="{{ asset('storage/' . $events->image) }}" style="height: 400px";
                        width="500px"; alt="{{ $events->event_name }}" />
                    <!-- Product details-->
                    <div class="card-body card-body-custom pt-4">
                        <div>
                            <!-- Product name-->
                            <h3 class="fw-bolder text-primary">Event Name</h3>
                            
                              <h4 class="fw-bolder">{{ $events->event_name }}</h4>
                            

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-5">
                <div class="card">
                    <!-- Product details-->
                    <div class="card-body card-body-custom pt-4">
                        <div class="text-center">
                            <!-- Product name-->
                            <div class="d-flex justify-content-between align-items-center">
                               
                                <div class="rent-price mb-3">
                                    <span class="text-primary">Rp.{{ number_format($ticket->price) }}</span>
                                </div>
                            </div>
                            <ul class="list-unstyled list-style-group">
                              <li class="border-bottom p-2 d-flex justify-content-between">
                                <span>Jumlah Ticket</span>
                                <span style="font-weight: 600">{{ $ticket->quantity }}</span>
                              </li>
                              <li class="border-bottom p-2 d-flex justify-content-between">
                                <span>Paket</span>
                                <span style="font-weight: 600">{{ $ticket->ticket_type }}</span>
                              </li>
                              <li class="border-bottom p-2 d-flex justify-content-between">
                                <span>Date</span>
                                <span style="font-weight: 600">{{ $events->event_date }}</span>
                              </li>
                              <li class="border-bottom p-2 d-flex justify-content-between">
                                <span>Time</span>
                                <span style="font-weight: 600">{{ $events->start_time }}-{{ $events->end_time }}</span>
                              </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Product actions-->
                    <div class="card-footer border-top-0 bg-transparent">
                        <div class="text-center">
                            <a class="btn d-flex align-items-center justify-content-center btn-primary mt-auto"
                                href="{{ route('beli', $events->id) }}" style="column-gap: 0.4rem">Beli Ticket<i class="ri-whatsapp-line"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
