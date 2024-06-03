@extends('layouts.app')

@section('contents')
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
                            <tr>
                                <td>{{ $selectedEvent->event_name }}</td>
                                <td>{{ $selectedTicket->ticket_type }}</td>
                                <td>{{ $selectedEvent->location }}</td>
                                <td>{{ $selectedTicket->price }}</td>
                                <td>{{ $selectedEvent->event_date }}</td>
                                <td>{{ $selectedEvent->start_time }}</td>
                                <td>{{ $selectedEvent->end_time }}</td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="7" class="text-center">No data available</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <!-- DataTables Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4>Pilih Metode Pembayaran</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('submit-form') }}" method="post">
                @csrf
                <input type="hidden" name="event_id" value="{{ $selectedEvent->id }}">
                <input type="hidden" name="ticket_id" value="{{ $selectedTicket->id }}">
            
                <label for="payment_method">Pilih Metode Pembayaran:</label><br>
                <label>
                    <input type="radio" name="payment_method" value="Dana" required> Dana
                </label><br>
                <label>
                    <input type="radio" name="payment_method" value="Gopay" required> Gopay
                </label><br>
                <label>
                    <input type="radio" name="payment_method" value="Bank BCA" required> Bank BCA
                </label><br>
                <br>
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-check"></i> Checkout
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

<!-- Page level plugins -->
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
@endsection
