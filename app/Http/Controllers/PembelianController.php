<?php

namespace App\Http\Controllers;

use App\Models\Beli;
use App\Models\Ticket;
use App\Models\History;
use App\Models\Transactions;
use Illuminate\Http\Request;
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
    
        if ($transaction) {
            // Cek dan kurangi quantity di tabel tickets
            $ticket = Ticket::where('ticket_type', $transaction->ticket_type)
                            ->first();
    
            if ($ticket && $ticket->quantity > 0) {
                // Kurangi quantity tiket
                $ticket->quantity -= 1;
                $ticket->save();
    
                // Pindahkan data ke tabel histories
                $history = History::create([
                    'event_name' => $transaction->event_name,
                    'ticket_type' => $transaction->ticket_type,
                    'location' => $transaction->location,
                    'price' => $transaction->price,
                    'tanggal' => $transaction->tanggal,
                    'start' => $transaction->start,
                    'end' => $transaction->end,
                    'payment_method' => $transaction->payment_method,
                    'user_id'=>auth()->id(),
                  
                ]);
    dd($history);
                // Hapus transaksi dari tabel transactions
                $transaction->delete();
    
                // Redirect ke halaman struk dengan pesan sukses dan data history
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
            } else {
                // Jika tiket tidak ditemukan atau quantity sudah habis
                return redirect()->back()->with('error', 'Tiket tidak tersedia.');
            }
        } else {
            // Jika transaksi tidak ditemukan
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan.');
        }
    }
    
}