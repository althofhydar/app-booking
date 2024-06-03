<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Ticket;

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
 


public function search(Request $request)
{
    $query = $request->input('query');
    $events = Event::where('event_name', 'like', "%{$query}%")
                    ->orWhere('event_date', 'like', "%{$query}%")
                    ->get();

    return view('events', ['events' => $events]);
}


}
