<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $table['events'] = Event::all();
        return view('event.index',$table);// Logika untuk menampilkan daftar event
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'event_name' => 'required',
            'event_date' => 'required|date',
            'location' => 'required',
        ]);

        $event = Event::findOrFail($id);
        $event->update([
            'event_name' => $request->event_name,
            'event_date' => $request->event_date,
            'location' => $request->location,
        ]);

        return redirect()->back()->with('success', 'Event updated successfully.');
    }

    // Delete an existing event
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->back()->with('success', 'Event deleted successfully.');
    }


    // Fungsi untuk menyimpan event baru
    public function store(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'event_name' => 'required|string|max:255',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
        ]);

        // Buat event baru
        $event = new Event();
        $event->event_name = $validatedData['event_name'];
        $event->event_date = $validatedData['event_date'];
        $event->location = $validatedData['location'];
        $event->save();

        // Redirect ke halaman event dengan pesan sukses
        return redirect()->route('event.index')->with('success', 'Event berhasil ditambahkan.');
    }
}


