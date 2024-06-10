<!-- resources/views/history.blade.php -->
@extends('layouts.app')

@section('contents')

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4>Table History</h4>
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
                        @if($histories->isEmpty())
                        <tr>
                            <td colspan="9" class="text-center">No data available</td>
                        </tr>
                    @else
                        @foreach($histories as $history)
                            <tr>
                                <td>{{ $history->event_name }}</td>
                                <td>{{ $history->ticket_type }}</td>
                                <td>{{ $history->location }}</td>
                                <td>{{ $history->price }}</td>
                                <td>{{ $history->tanggal }}</td>
                                <td>{{ $history->start }}</td>
                                <td>{{ $history->end }}</td>
                                <td>{{ $history->payment_method }}</td>
                                <td style="width: 140px;">
                                    <button class="btn btn-primary print-row" data-id="{{ $history->id }}">Cetak</button>
                                </td>
                                
                            </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
