<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventCategory;
use Illuminate\Http\Request;

class EventCategoryController extends Controller
{
    public function index(Event $event)
    {
        $categories = $event->categories()->orderBy('name')->get();
        return view('admin.event-categories.index', compact('event', 'categories'));
    }

    public function store(Request $request, Event $event)
    {
        $event->categories()->create($this->validatedData($request));
        return redirect()->route('admin.events.categories.index', $event)->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function update(Request $request, Event $event, EventCategory $category)
    {
        abort_unless($category->event_id === $event->id, 404);
        $category->update($this->validatedData($request));
        return redirect()->route('admin.events.categories.index', $event)->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Event $event, EventCategory $category)
    {
        abort_unless($category->event_id === $event->id, 404);
        $category->delete();
        return redirect()->route('admin.events.categories.index', $event)->with('success', 'Kategori berhasil dihapus. Snapshot peserta lama tetap tersimpan.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'normal_price' => ['required', 'numeric', 'min:0'],
            'early_bird_price' => ['nullable', 'numeric', 'min:0'],
            'early_bird_start' => ['nullable', 'date', 'required_with:early_bird_end,early_bird_price'],
            'early_bird_end' => ['nullable', 'date', 'after_or_equal:early_bird_start', 'required_with:early_bird_start,early_bird_price'],
        ]) + ['is_active' => $request->boolean('is_active')];
    }
}
