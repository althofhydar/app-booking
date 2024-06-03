<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Beli;
use App\Models\Transactions;

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
    
}
