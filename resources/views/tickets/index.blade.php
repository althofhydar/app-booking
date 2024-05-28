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
            <h1 class="h3 mb-2 text-gray-800">Table Ticket</h1>

            <!-- DataTables Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addTicketModal">
                        <i class="fas fa-plus"></i> Tambah Ticket
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Event Name</th>
                                    <th>Ticket Type</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($no = 1)
                                @foreach ($tickets as $row)
                                    <tr>
                                        <th>{{ $no++ }}</th>
                                        <td>{{ $row->event->event_name }}</td>
                                        <td>{{ $row->ticket_type }}</td>
                                        <td>{{ $row->price }}</td>
                                        <td>{{ $row->quantity }}</td>
                                        <td>
                                            <button class="btn btn-warning" data-toggle="modal" data-target="#editTicketModal-{{ $row->id }}"><i class="fas fa-pen-alt"></i> Edit</button>
                                            <button class="btn btn-danger" data-toggle="modal" data-target="#deleteTicketModal-{{ $row->id }}"><i class="fas fa-trash"></i> Hapus</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

        <!-- Add Ticket Modal -->
        <div class="modal fade" id="addTicketModal" tabindex="-1" role="dialog" aria-labelledby="addTicketModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addTicketModalLabel">Add Ticket</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('ticket.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="event_id">Event ID</label>
                                <select class="form-control" id="event_id" name="event_id" required>
                                    @foreach ($events as $event)
                                        <option value="{{ $event->id }}">{{ $event->event_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="ticket_type">Ticket Type</label>
                                <select class="form-control" id="ticket_type" name="ticket_type" required>
                                    <option value="VIP">VIP</option>
                                    <option value="Regular">Regular</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" class="form-control" id="price" name="price" required>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Ticket Modal -->
        @foreach ($tickets as $row)
        <div class="modal fade" id="editTicketModal-{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="editTicketModalLabel-{{ $row->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editTicketModalLabel-{{ $row->id }}">Edit Ticket</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('ticket.update', $row->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="event_id">Event ID</label>
                                <select class="form-control" id="event_id" name="event_id" required>
                                    @foreach ($events as $event)
                                        <option value="{{ $event->id }}" {{ $row->event_id == $event->id ? 'selected' : '' }}>{{ $event->event_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="ticket_type">Ticket Type</label>
                                <select class="form-control" id="ticket_type" name="ticket_type" required>
                                    <option value="VIP" {{ $row->ticket_type == 'VIP' ? 'selected' : '' }}>VIP</option>
                                    <option value="Regular" {{ $row->ticket_type == 'Regular' ? 'selected' : '' }}>Regular</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" class="form-control" id="price" name="price" value="{{ $row->price }}" required>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $row->quantity }}" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach

        <!-- Delete Ticket Modal -->
        @foreach ($tickets as $row)
        <div class="modal fade" id="deleteTicketModal-{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteTicketModalLabel-{{ $row->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteTicketModalLabel-{{ $row->id }}">Delete Ticket</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this ticket?
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('ticket.destroy', $row->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

    </div>
    <!-- /#wrapper -->

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
