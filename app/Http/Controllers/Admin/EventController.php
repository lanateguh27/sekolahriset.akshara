<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    // Menampilkan daftar event
    public function index()
    {
        $events = Event::latest('event_date')->paginate(10);

        return view('admin.events.index', compact('events'));
    }

    // Menampilkan formulir tambah event
    public function create()
    {
        return view('admin.events.create');
    }

    // Menyimpan event baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'location' => ['nullable', 'string', 'max:255'],
            'event_date' => ['required', 'date'],
            'speaker_name' => ['nullable', 'string', 'max:255'],
            'poster' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'status' => ['required', 'in:draft,published'],
        ]);

        if ($request->hasFile('poster')) {
            $validated['poster'] = $request->file('poster')
                ->store('event-posters', 'public');
        }

        Event::create($validated);

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event berhasil ditambahkan.');
    }


    // Menampilkan formulir edit event
    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    // Memperbarui event
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'location' => ['nullable', 'string', 'max:255'],
            'event_date' => ['required', 'date'],
            'speaker_name' => ['nullable', 'string', 'max:255'],
            'poster' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'status' => ['required', 'in:draft,published'],
        ]);

        // Jika poster baru diunggah, hapus poster lama
        if ($request->hasFile('poster')) {
            if ($event->poster) {
                Storage::disk('public')->delete($event->poster);
            }

            $validated['poster'] = $request->file('poster')
                ->store('event-posters', 'public');
        }

        $event->update($validated);

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event berhasil diperbarui.');
    }

    // Menghapus event
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event berhasil dihapus.');
    }
}