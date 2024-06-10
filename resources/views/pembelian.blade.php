@extends('layouts.app')

@section('contents')
<div class="container-fluid">
    <!-- Page Heading -->
   

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4>Table Pembelian</h4>
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
                            <th>Date</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Metode Pembayaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                
                    <tbody>
                        @foreach($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->event_name }}</td>
                            <td>{{ $transaction->ticket_type }}</td>
                            <td>{{ $transaction->location }}</td>
                            <td>{{ $transaction->price }}</td>
                            <td>{{ $transaction->tanggal }}</td>
                            <td>{{ $transaction->start }}</td>
                            <td>{{ $transaction->end }}</td>
                            <td>{{ $transaction->payment_method }}</td>
                            <td style="width: 140px;">
                                <button class="btn btn-success" data-toggle="modal" data-target="#purchaseModal{{ $transaction->id }}"><i class="fas fa-shopping-cart"></i></button>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#deleteEventModal{{ $transaction->id }}"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        
                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteEventModal{{ $transaction->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteEventModalLabel{{ $transaction->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteEventModalLabel{{ $transaction->id }}">Hapus Pembelian</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Apakah anda yakin ingin menghapus Pembelian {{ $transaction->event_name }}?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
                                        <form action="{{ route('pembelian.destroy', $transaction->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Batal Pembelian</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                      <!-- Purchase Modal -->
<div class="modal fade" id="purchaseModal{{ $transaction->id }}" tabindex="-1" role="dialog" aria-labelledby="purchaseModalLabel{{ $transaction->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="purchaseModalLabel{{ $transaction->id }}">Konfirmasi Pembelian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin ingin membeli tiket untuk event {{ $transaction->event_name }}?</p>
                <p>Ticket Type: {{ $transaction->ticket_type }}</p>
                <p>Location: {{ $transaction->location }}</p>
                <p>Price: {{ $transaction->price }}</p>
                <p>Date: {{ $transaction->tanggal }}</p>
                <p>Start Time: {{ $transaction->start }}</p>
                <p>End Time: {{ $transaction->end }}</p>
                <p>Metode Pembayaran: {{ $transaction->payment_method }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
                <form action="{{ route('pembelian.confirm', $transaction->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-success">Konfirmasi Pembelian</button>
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
</div>
@endsection


@section('scripts')
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
