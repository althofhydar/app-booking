<?php

namespace App\Http\Controllers;

use App\Models\Cek;
use App\Models\Event;
use App\Models\Ticket;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class HistoryController extends Controller
{
    public function index()
    {
        $histories = History::all();
        return view('history', compact('histories'));
    }
    public function addToCeks(Request $request)
    {
        $data = $request->all();

        // Masukkan data ke tabel 'ceks'
        $ceks = new Cek();
        $ceks->event_name = $data['event_name'];
        $ceks->ticket_type = $data['ticket_type'];
        $ceks->location = $data['location'];
        $ceks->price = $data['price'];
        $ceks->tanggal = $data['tanggal'];
        $ceks->start = $data['start'];
        $ceks->end = $data['end'];
        $ceks->payment_method = $data['payment_method'];
        $ceks->save();
    
        // Pembaruan status di tabel 'history'
        $history = History::find($data['id']);
        if ($history) {
            $history->status = 'await';
            $history->save();
        }
    
        return response()->json(['success' => true]);
    }
    public function confirm($ticket_type)
    {
        try {
            // Cari history berdasarkan ticket_type
            $history = History::where('ticket_type', $ticket_type)->firstOrFail();
            
            // Periksa jika status sudah confirm
            if ($history->status !== 'confirm') {
                $history->status = 'confirm';
                $history->save();
            }
    
            return redirect()->back()->with('success', 'Event telah dikonfirmasi.');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Event tidak ditemukan.');
        }
    }
    
}