<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\Ticket; // Assuming your Ticket model namespace

class TicketController extends Controller
{
    public function index()
    {
        // Fetch all tickets from the database
        $tickets = Ticket::all();
        $events = Event::all(); 
        // Pass the tickets data to the view
        return view('tickets.index', compact('tickets','events'));
    }

    public function tambah()
    {
        // You may need to pass additional data like events for dropdown options
        // $events = Event::all();
        // return view('ticket.tambah', compact('events'));
        
        // For now, assuming you don't need any additional data
        return view('ticket.tambah');
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'event_id' => 'required|exists:events,id',
            'ticket_type' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
        ]);

        // Create a new ticket instance and save it
        Ticket::create($validatedData);

        // Redirect back with success message or any other action
        return redirect()->route('ticket.index')->with('success', 'Ticket added successfully.');
    }

    public function edit($id)
    {
        // Find the ticket by id
        $ticket = Ticket::findOrFail($id);

        // Pass the ticket data to the view
        return view('ticket.edit', compact('ticket'));
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'event_id' => 'required|exists:events,id',
            'ticket_type' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
        ]);

        // Find the ticket by id and update its data
        $ticket = Ticket::findOrFail($id);
        $ticket->update($validatedData);

        // Redirect back with success message or any other action
        return redirect()->route('ticket.index')->with('success', 'Ticket updated successfully.');
    }

    public function destroy($id)
    {
        // Find the ticket by id and delete it
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();

        // Redirect back with success message or any other action
        return redirect()->route('ticket.index')->with('success', 'Ticket deleted successfully.');
    }
}
