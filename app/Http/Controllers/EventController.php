<?php

// app/Http/Controllers/EventController.php
namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::upcoming()->get();
        return view('events.index', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'time' => 'required|string', 
            'location' => 'required|string', 
            'max_participants' => 'nullable|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);
        $path = $request->file(key: 'image')->storePublicly('photos', 'public');
        $ext = $request->file('image')->extension();
        $validatedData['image'] = $path;
        $event = Event::create($validatedData);

        // return redirect()->route('events.index')
        //     ->with('success', 'Event berhasil dibuat');
        return redirect('/admin');

    }

    public function register(Request $request, $eventId)
    {
        $event = Event::findOrFail($eventId);
        $user = auth()->user();

        // Cek apakah user sudah terdaftar
        if ($event->participants()->where('user_id', $user->id)->exists()) {
            return back()->with('error', 'Anda sudah terdaftar di event ini');
        }

        $event->participants()->attach($user->id);

        return back()->with('success', 'Registrasi event berhasil');
    }
}
?>