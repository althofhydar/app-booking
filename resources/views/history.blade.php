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
                            <th>Nama Acara</th>
                            <th>Jenis Tiket</th>
                            <th>Lokasi</th>
                            <th>Harga</th>
                            <th>Tanggal</th>
                            <th>Mulai</th>
                            <th>Selesai</th>
                            <th>Metode Pembayaran</th>
                        </tr>
                    </thead>
              
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
