<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Ticket;
use App\Models\Transaction;
use App\Models\Transactions;

class HomeController extends Controller

{
 public function index()
 {
     $events = Event::all();
     $tickets = Ticket::all();
   

     return view('events', compact('events', 'tickets'));
 }
 

 public function detail($id)
 {
     // Mengambil satu data Event berdasarkan ID
     $events = Event::findOrFail($id);
 
     // Mengambil tiket yang berkaitan dengan event tersebut berdasarkan event_id
     $tickets = Ticket::where('event_id', $id)->get();
//  dd($tickets);
     return view('detail', compact('events', 'tickets'));
 }
 





 public function beli($ticket_type)
 {
     // Ambil data tiket berdasarkan ticket_type
     $selectedTicket = Ticket::where('ticket_type', $ticket_type)->firstOrFail();
 
     // Ambil data acara yang terkait dengan tiket yang dipilih
     $selectedEvent = $selectedTicket->event;
 
     // Kembalikan view bersama dengan data acara dan tiket
     return view('beli', compact('selectedEvent', 'selectedTicket'));
 }

 public function submitForm(Request $request)
 {
     // Validasi request data
     $validated = $request->validate([
         'event_id' => 'required|integer|exists:events,id',
         'ticket_id' => 'required|integer|exists:tickets,id',
         'payment_method' => 'required|string'
     ]);
 
     // Dapatkan data event dari database berdasarkan event_id
     $event = Event::findOrFail($validated['event_id']);
     
     // Dapatkan data tiket dari database berdasarkan ticket_id
     $ticket = Ticket::findOrFail($validated['ticket_id']);
 
     // Simpan data transaksi
     $transaction = new Transactions();
     // Assign event name to transaction
     $transaction->event_name = $event->event_name;
     // Assign ticket type to transaction
     $transaction->ticket_type = $ticket->ticket_type;
     // Assign other necessary data to transaction
     $transaction->location = $event->location;
     $transaction->price = $ticket->price;
     $transaction->tanggal = $event->event_date;
     $transaction->start = $event->start_time;
     $transaction->end = $event->end_time;
     $transaction->payment_method = $validated['payment_method'];
     $transaction->save();
 
     // Redirect ke halaman checkout dengan ID transaksi
     return redirect()->route('pembelian', $transaction->id);
 }
 
 public function checkout($transactionId)
 {
     // Dapatkan data transaksi berdasarkan ID yang diberikan
     $transaction = Transactions::findOrFail($transactionId);
     // Kirim data transaksi ke view 'pembelian'
     return view('pembelian', compact('transaction'));
 }
 

}
