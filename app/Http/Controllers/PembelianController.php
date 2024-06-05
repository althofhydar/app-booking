<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Beli;
use App\Models\History;
use App\Models\Transactions;
use Barryvdh\DomPDF\Facade\Pdf;

class PembelianController extends Controller
{
  

    public function index()
    {
        // Mengambil semua data transaksi dari tabel transactions
        $transactions = Transactions::all();
        
        // Mengirim data transaksi ke view 'pembelian' untuk ditampilkan
        return view('pembelian', compact('transactions'));
    }

    public function destroy($id)
    {
        $Transactions = Transactions::findOrFail($id);

        $Transactions->delete();

        return redirect()->back()->with('success', 'Pembelian deleted successfully.');
    }
    public function confirm(Request $request, $id)
    {
        // Ambil detail transaksi
        $transaction = Transactions::find($id);

        // Lakukan logika konfirmasi pembelian
        $transaction->confirmed = true;
        $transaction->save();

        // Siapkan data struk
        $receiptData = [
            'event_name' => $transaction->event_name,
            'ticket_type' => $transaction->ticket_type,
            'location' => $transaction->location,
            'price' => $transaction->price,
            'tanggal' => $transaction->tanggal,
            'start' => $transaction->start,
            'end' => $transaction->end,
            'payment_method' => $transaction->payment_method,
        ];

        // Generate PDF
        $pdf = Pdf::loadView('receipt', ['receipt' => $receiptData]);
        
        // Return PDF sebagai respons
        return $pdf->stream('receipt.pdf');
    }
}