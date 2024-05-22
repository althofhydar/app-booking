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

    <title>Tabel Event</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Table Event</h1>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addEventModal">
                        <i class="fas fa-plus"></i> Tambah Event
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Event</th>
                                    <th>Jadwal Event</th>
                                    <th>Lokasi Event</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($no = 1)
                                @foreach ($events as $row)
                                    <tr>
                                        <th>{{ $no++ }}</th>
                                        <td>{{ $row->event_name }}</td>
                                        <td>{{ $row->event_date }}</td>
                                        <td>{{ $row->location }}</td>
                                        <td>
                                            <button class="btn btn-warning" data-toggle="modal" data-target="#editEventModal{{ $row->id }}"><i class="fas fa-pen-alt"></i> Edit</button>
                                            <button class="btn btn-danger" data-toggle="modal" data-target="#deleteEventModal{{ $row->id }}"><i class="fas fa-trash"></i> Hapus</button>
                                        </td>
                                    </tr>

                                    <!-- Edit Event Modal -->
                                    <div class="modal fade" id="editEventModal{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="editEventModalLabel{{ $row->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editEventModalLabel{{ $row->id }}">Edit Event</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('event.update', $row->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group">
                                                            <label for="event_name">Nama Event</label>
                                                            <input type="text" class="form-control" id="event_name" name="event_name" value="{{ $row->event_name }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="event_date">Jadwal Event</label>
                                                            <input type="date" class="form-control" id="event_date" name="event_date" value="{{ $row->event_date }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="location">Lokasi Event</label>
                                                            <input type="text" class="form-control" id="location" name="location" value="{{ $row->location }}" required>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Update Event</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Delete Event Modal -->
                                    <div class="modal fade" id="deleteEventModal{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteEventModalLabel{{ $row->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteEventModalLabel{{ $row->id }}">Hapus Event</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apakah anda yakin ingin menghapus event {{ $row->event_name }}?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                    <form action="{{ route('event.destroy', $row->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Hapus Event</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Add Event Modal -->
            <div class="modal fade" id="addEventModal" tabindex="-1" role="dialog" aria-labelledby="addEventModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addEventModalLabel">Tambah Event</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('event.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="event_name">Nama Event</label>
                                    <input type="text" class="form-control" id="event_name" name="event_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="event_date">Jadwal Event</label>
                                    <input type="date" class="form-control" id="event_date" name="event_date" required>
                                </div>
                                <div class="form-group">
                                    <label for="location">Lokasi Event</label>
                                    <input type="text" class="form-control" id="location" name="location" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Tambah Event</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#wrapper -->

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

</body>
</html>
@endsection
