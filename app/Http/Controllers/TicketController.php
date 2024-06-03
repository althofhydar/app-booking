<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
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
        $request->validate([
            'event_id' => [
                'required',
                Rule::unique('tickets')->where(function ($query) use ($request) {
                    return $query->where('ticket_type', $request->ticket_type);
                }),
            ],
            'ticket_type' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
        ], [
            'event_id.unique' => 'The combination of Event and Ticket Type already exists.'
        ]);
    
        // Create the ticket if validation passes
        Ticket::create([
            'event_id' => $request->event_id,
            'ticket_type' => $request->ticket_type,
            'price' => $request->price,
            'quantity' => $request->quantity,
        ]);
    
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
        $request->validate([
            'event_id' => [
                'required',
                Rule::unique('tickets')->where(function ($query) use ($request, $id) {
                    return $query->where('ticket_type', $request->ticket_type)->where('id', '!=', $id);
                }),
            ],
            'ticket_type' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
        ], [
            'event_id.unique' => 'The combination of Event and Ticket Type already exists.'
        ]);
    
        $ticket = Ticket::find($id);
        $ticket->update([
            'event_id' => $request->event_id,
            'ticket_type' => $request->ticket_type,
            'price' => $request->price,
            'quantity' => $request->quantity,
        ]);
    
        return redirect()->route('ticket.index')->with('success', 'Ticket updated successfully.');
    }

    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();

        return redirect()->back()->with('success', 'Ticket deleted successfully.');
    }
    
}