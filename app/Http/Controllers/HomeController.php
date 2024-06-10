<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Ticket;
use App\Models\History;
use App\Models\Transactions;

class HomeController extends Controller

{
 public function index()
 {
     $events = Event::all();
     $tickets = Ticket::all();
     $acakevent = $events->shuffle();
   

     return view('events', compact('acakevent', 'tickets'));
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
     // Validate request data
     $validated = $request->validate([
         'event_id' => 'required|integer|exists:events,id',
         'ticket_id' => 'required|integer|exists:tickets,id',
         'payment_method' => 'required|string'
     ]);
 
     // Check for existing transaction in history table
     $existingTransaction = History::where('event_name', Event::find($validated['event_id'])->event_name)
                                   ->where('ticket_type', Ticket::find($validated['ticket_id'])->ticket_type)
                                   ->first();
 
     if ($existingTransaction) {
         // Redirect back with an error message
         return redirect()->back()->with('error', 'Data sudah ada di table history.');
     }

     $existingTransaction = Transactions::where('event_name', Event::find($validated['event_id'])->event_name)
     ->where('ticket_type', Ticket::find($validated['ticket_id'])->ticket_type)
     ->first();

if ($existingTransaction) {
// Redirect back with an error message
return redirect()->back()->with('error', 'Data sudah ada di table Pembelian.');
}
 
     // Get event data from database based on event_id
     $event = Event::findOrFail($validated['event_id']);
     
     // Get ticket data from database based on ticket_id
     $ticket = Ticket::findOrFail($validated['ticket_id']);
 
     // Save transaction data
     $transaction = new Transactions(); // Assuming History is the model for your history table
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
 
     // Redirect to the checkout page with the transaction ID
     return redirect()->route('pembelian', $transaction->id);
 }
 
 public function checkout($transactionId)
 {
     // Get transaction data based on the provided ID
     $transaction = History::findOrFail($transactionId); // Assuming History is the model for your history table
     // Send transaction data to the 'pembelian' view
     return view('pembelian', compact('transaction'));
 }
} 