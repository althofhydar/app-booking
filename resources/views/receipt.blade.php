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
        }
        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
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
            margin-bottom: 20px;
        }
        .details h2 {
            border-bottom: 2px solid #333;
            padding-bottom: 5px;
        }
        .details p {
            margin: 5px 0;
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
            <p><strong>Nama Acara:</strong> {{ $receipt['event_name'] }}</p>
            <p><strong>Jenis Tiket:</strong> {{ $receipt['ticket_type'] }}</p>
            <p><strong>Lokasi:</strong> {{ $receipt['location'] }}</p>
            <p><strong>Harga:</strong> Rp {{ number_format($receipt['price'], 0, ',', '.') }}</p>
            <p><strong>Tanggal:</strong> {{ $receipt['tanggal'] }}</p>
            <p><strong>Waktu Mulai:</strong> {{ $receipt['start'] }}</p>
            <p><strong>Waktu Berakhir:</strong> {{ $receipt['end'] }}</p>
            <p><strong>Metode Pembayaran:</strong> {{ $receipt['payment_method'] }}</p>
        </div>
        <div class="footer">
            <p>Ini adalah struk elektronik. Tidak perlu tanda tangan.</p>
        </div>
    </div>
</body>
</html>
