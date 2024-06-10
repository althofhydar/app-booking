<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    // Display a listing of events
    public function index()
    {
        $table['events'] = Event::all();
        return view('event.index', $table);
    }

    // Store a newly created event
    public function store(Request $request)
    {
        $request->validate([
            'event_name' => 'required|string|max:255',
            'event_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1000000',
        ]);

        $path = $request->hasFile('image') ? $request->file('image')->store('event_images', 'public') : null;

        Event::create([
            'event_name' => $request->event_name,
            'event_date' => $request->event_date,
            'location' => $request->location,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'image' => $path,
        ]);

        return redirect()->route('event.index')->with('success', 'Event created successfully.');
    }

    // Update the specified event
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

    // Remove the specified event
    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }

        $event->delete();

        return redirect()->back()->with('success', 'Event deleted successfully.');
    }

    public function show($id)
{
    $selectedEvent = Event::with('tickets')->findOrFail($id);
    return view('beli', compact('selectedEvent'));
}
}
