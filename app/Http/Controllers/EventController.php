<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        $table['events'] = Event::all();
        return view('event.index',$table);// Logika untuk menampilkan daftar event
    }

    

 // Fungsi untuk menyimpan event baru
 public function store(Request $request)
 {
     $request->validate([
         'event_name' => 'required|string|max:255',
         'event_date' => 'required|date',
         'location' => 'required|string|max:255',
         'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
     ]);
 
     if ($request->hasFile('image')) {
         $path = $request->file('image')->store('event_images', 'public');
     } else {
         $path = null;
     }
 
     Event::create([
         'event_name' => $request->event_name,
         'event_date' => $request->event_date,
         'location' => $request->location,
         'image' => $path,
     ]);
 
     return redirect()->route('event.index')->with('success', 'Event created successfully.');
 }













    public function update(Request $request, $id)
    {
        $request->validate([
            'event_name' => 'required|string|max:255',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $event = Event::findOrFail($id);
    
        if ($request->hasFile('image')) {
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            $path = $request->file('image')->store('event_images', 'public');
            $event->image = $path;
        }
    
        $event->update([
            'event_name' => $request->event_name,
            'event_date' => $request->event_date,
            'location' => $request->location,
            'image' => $event->image,
        ]);
    
        return redirect()->route('event.index')->with('success', 'Event updated successfully.');
    }

    // Delete an existing event
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->back()->with('success', 'Event deleted successfully.');
    }


   
}


