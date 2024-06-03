@extends('layouts.app')

@section('contents')




    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Begin Page Content -->
        <div class="container-fluid">
          
            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Transaksi</h1>

            <!-- DataTables Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <a href="{{ route('events') }}" class="btn btn-primary">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Event Name</th>
                                    <th>Ticket Type</th>
                                    <th>Location</th>
                                    <th>Price</th>
                                    <th>Tanggal</th>
                                    <th>Start</th>
                                    <th>End</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($selectedEvent)
                                @foreach ($tickets->where('event_id', $selectedEvent->id) as $ticket)
                                    <tr>
                                        <td>{{ $selectedEvent->event_name }}</td>
<<<<<<< HEAD
                                        <td>{{ $selectedTicket->ticket_type }}</td>
                                        <td>{{ $selectedEvent->location }}</td>
                                        <td>{{ $selectedTicket->price }}</td>
=======
                                        <td>{{ $ticket->ticket_type }}</td>
                                        <td>{{ $selectedEvent->location }}</td>
                                        <td>{{ $ticket->price }}</td>
>>>>>>> 4aaf9f52f0abc08a52373f25218efeb818041dd6
                                        <td>{{ $selectedEvent->event_date }}</td>
                                        <td>{{ $selectedEvent->start_time }}</td>
                                        <td>{{ $selectedEvent->end_time }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <!-- Handle if there is no selected event -->
                            @endif
                            
                            
                           
                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>

    <div id="wrapper">

        <!-- Begin Page Content -->
        <div class="container-fluid">
          
           
            <!-- DataTables Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h4>Pilih Metode Pembayaran</h4>
                </div>
                <div class="card-body">
                    <form action="/submit-form" method="post">
                        <label for="checkbox1">
                            <input type="checkbox" id="checkbox1" name="option1" value="Option 1">
                            Dana
                        </label><br>
                        <label for="checkbox2">
                            <input type="checkbox" id="checkbox2" name="option2" value="Option 2">
                            Gopay
                        </label><br>
                        <label for="checkbox3">
                            <input type="checkbox" id="checkbox3" name="option3" value="Option 3">
                            Bank BCA
                        </label><br>
                        <br>
                        <a href="" class="btn btn-primary">
                            <i class="">Checkout</i>
                        </a>
                    </form>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /.wrapper -->


</section>
@endsection
