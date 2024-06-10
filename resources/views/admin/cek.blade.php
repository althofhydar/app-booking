@extends('layouts.app')

@section('contents')

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4>Table cek</h4>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Event Name</th>
                            <th>Ticket Type</th>
                            <th>Location</th>
                            <th>Price</th>
                            <th>Date</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Metode Pembayaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cek as $item)
                        <tr>
                            <td>{{ $item->event_name }}</td>
                            <td>{{ $item->ticket_type }}</td>
                            <td>{{ $item->location }}</td>
                            <td>{{ $item->price }}</td>
                            <td>{{ $item->tanggal }}</td>
                            <td>{{ $item->start }}</td>
                            <td>{{ $item->end }}</td>
                            <td>{{ $item->payment_method }}</td>
                            <td style="width: 140px;">
                                <form action="{{ route('confirm', $item->ticket_type) }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn btn-success">Konfirmasi</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
