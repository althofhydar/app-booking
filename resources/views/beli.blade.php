@extends('layouts.app')

@section('contents')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tabel Ticket</title>

    <!-- Custom fonts for this template -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

</head>

<body id="page-top">

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
                                    <tr>
                                        <td>{{ $selectedEvent->event_name }}</td>
                                        <td>{{ $selectedEvent->ticket_type }}</td>
                                        <td>{{ $selectedEvent->location }}</td>
                                        <td>{{ $selectedEvent->price }}</td>
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

</body>

</html>
@endsection
