<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembelian</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f9f9f9;
        }
        .container {
            width: 80%;
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #fff;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
        }
        .header p {
            margin: 0;
            font-size: 14px;
        }
        .details {
            margin-bottom: 10px;
        }
        .details h2 {
            border-bottom: 2px solid #333;
            padding-bottom: 5px;
            text-align: center;
        }
        .details .detail-item {
            display: grid;
            grid-template-columns: 1fr 1fr;
            margin: 15px 0;
        }
        .details .detail-item strong {
            text-align: left;
        }
        .details .detail-item span {
            text-align: right;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Struk Pembelian</h1>
            <p>Terima kasih atas pembelian Anda!</p>
        </div>
        <div class="details">
            <h2>Detail Pembelian</h2>
            <div class="detail-item">
                <strong>Event Name:</strong>
                <span>{{ $receipt['event_name'] }}</span>
            </div>
            <div class="detail-item">
                <strong>Ticket Type:</strong>
                <span>{{ $receipt['ticket_type'] }}</span>
            </div>
            <div class="detail-item">
                <strong>Location:</strong>
                <span>{{ $receipt['location'] }}</span>
            </div>
            <div class="detail-item">
                <strong>Price:</strong>
                <span>Rp {{ number_format($receipt['price'], 0, ',', '.') }}</span>
            </div>
            <div class="detail-item">
                <strong>Date:</strong>
                <span>{{ $receipt['tanggal'] }}</span>
            </div>
            <div class="detail-item">
                <strong>Start Time:</strong>
                <span>{{ $receipt['start'] }}</span>
            </div>
            <div class="detail-item">
                <strong>End Time:</strong>
                <span>{{ $receipt['end'] }}</span>
            </div>
            <div class="detail-item">
                <strong>Metode Pembayaran:</strong>
                <span>{{ $receipt['payment_method'] }}</span>
            </div>
        </div>
        <div class="footer">
            <p> <a href="{{ route('history') }}" class="btn btn-primary">Lihat History Pembelian</a></p>
        </div>
    </div>
</body>
</html>
