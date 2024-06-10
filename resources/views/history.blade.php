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
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
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
                                <td>{{ $history->status }}</td> <!-- Add status column -->
                                <td style="width: 140px;">
                                    @if ($history->status == 'await')
                                    <button class="btn btn-secondary" disabled>Cetak</button>
                                    @elseif ($history->status == 'confirm')
                                    <button class="btn btn-success print-row" 
                                            data-id="{{ $history->id }}" 
                                            data-event_name="{{ $history->event_name }}" 
                                            data-ticket_type="{{ $history->ticket_type }}" 
                                            data-location="{{ $history->location }}" 
                                            data-price="{{ $history->price }}" 
                                            data-tanggal="{{ $history->tanggal }}" 
                                            data-start="{{ $history->start }}" 
                                            data-end="{{ $history->end }}" 
                                            data-payment_method="{{ $history->payment_method }}">
                                        Cetak
                                    </button>
                                @else
                                    <button class="btn btn-primary print" 
                                            data-id="{{ $history->id }}" 
                                            data-event_name="{{ $history->event_name }}" 
                                            data-ticket_type="{{ $history->ticket_type }}" 
                                            data-location="{{ $history->location }}" 
                                            data-price="{{ $history->price }}" 
                                            data-tanggal="{{ $history->tanggal }}" 
                                            data-start="{{ $history->start }}" 
                                            data-end="{{ $history->end }}" 
                                            data-payment_method="{{ $history->payment_method }}">
                                        Cetak
                                    </button>
                                @endif
                                
                                </td>         
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const buttons = document.querySelectorAll('.print');
    
        buttons.forEach(button => {
            button.addEventListener('click', function() {
                // Ambil status dari data-id atribut
                const status = this.closest('tr').querySelector('td:nth-child(9)').textContent;

                // Jika status sudah 'await', maka nonaktifkan tombol
                if (status.trim() === 'await') {
                    this.classList.remove('btn-primary');
                    this.classList.add('btn-secondary');
                    this.disabled = true;
                    return; // Keluar dari fungsi jika status sudah 'await'
                }

                const eventData = {
                    event_name: this.dataset.event_name,
                    ticket_type: this.dataset.ticket_type,
                    location: this.dataset.location,
                    price: this.dataset.price,
                    tanggal: this.dataset.tanggal,
                    start: this.dataset.start,
                    end: this.dataset.end,
                    payment_method: this.dataset.payment_method,
                    id: this.dataset.id,
                    status: 'await'  // Update status to 'await'
                };
    
                fetch('/add-to-ceks', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(eventData)
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        this.classList.remove('btn-primary');
                        this.classList.add('btn-secondary');
                        this.disabled = true;
                        
                        // Optionally, you can also update the status in the table
                        const row = this.closest('tr');
                        const statusCell = row.querySelector('td:nth-child(9)');
                        statusCell.textContent = 'await';  // Update the status cell content
                    } else {
                        alert('Failed to add data to ceks table: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred: ' + error.message);
                });
            });
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const printButtons = document.querySelectorAll('.print-row');

        printButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const event_name = this.getAttribute('data-event_name');
                const ticket_type = this.getAttribute('data-ticket_type');
                const location = this.getAttribute('data-location');
                const price = this.getAttribute('data-price');
                const tanggal = this.getAttribute('data-tanggal');
                const start = this.getAttribute('data-start');
                const end = this.getAttribute('data-end');
                const payment_method = this.getAttribute('data-payment_method');

                // Example: Fetch or print logic here
                console.log(`Printing details for ID: ${id}`);
                console.log(`Event Name: ${event_name}`);
                // Add more console logs or processing as needed

                // For example, you can open a new window to display the data
                const printWindow = window.open('', '_blank');
                printWindow.document.write('<h1>Event Details</h1>');
                printWindow.document.write(`<p>Event Name: ${event_name}</p>`);
                printWindow.document.write(`<p>Ticket Type: ${ticket_type}</p>`);
                printWindow.document.write(`<p>Location: ${location}</p>`);
                printWindow.document.write(`<p>Price: ${price}</p>`);
                printWindow.document.write(`<p>Date: ${tanggal}</p>`);
                printWindow.document.write(`<p>Start: ${start}</p>`);
                printWindow.document.write(`<p>End: ${end}</p>`);
                printWindow.document.write(`<p>Payment Method: ${payment_method}</p>`);
                printWindow.document.close();
                printWindow.print();
            });
        });
    });
</script>

@endsection
