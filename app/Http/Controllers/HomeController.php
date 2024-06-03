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
 





public function beli($id)
{
    $events = Event::all();
    $selectedEvent = $events->find($id);
    
    $tickets = Ticket::where('event_id', $id)->get(); // Ambil tiket berdasarkan ID event
    // Jika menggunakan Eloquent, gunakan 'where' untuk mencari tiket yang terkait dengan event yang dipilih
    
    return view('beli', compact('events', 'tickets', 'selectedEvent'));
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
