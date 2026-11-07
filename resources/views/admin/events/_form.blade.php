<div class="form-group">
    <label for="title">Nama Event</label>

    <input
        type="text"
        id="title"
        name="title"
        value="{{ old('title', $event->title ?? '') }}"
        placeholder="Masukkan nama event"
        required
    >

    @error('title')
        <small class="form-error">{{ $message }}</small>
    @enderror
</div>

{{-- Nama Pemateri --}}
<div class="form-group">
    <label for="speaker_name">Nama Pemateri</label>

    <input
        type="text"
        id="speaker_name"
        name="speaker_name"
        value="{{ old('speaker_name', $event->speaker_name ?? '') }}"
        placeholder="Masukkan nama pemateri"
    >

    @error('speaker_name')
        <small class="form-error">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="poster">Poster Event</label>

    <input
        type="file"
        id="poster"
        name="poster"
        accept=".jpg,.jpeg,.png,.webp"
    >

    @error('poster')
        <small class="form-error">{{ $message }}</small>
    @enderror

    @if (!empty($event?->poster))
        <div class="current-poster">
            <p>Poster saat ini:</p>

            <img
                src="{{ asset('storage/' . $event->poster) }}"
                alt="Poster {{ $event->title }}"
                style="max-width: 220px; height: auto;"
            >
        </div>
    @endif
</div>

<div class="form-group">
    <label for="description">Deskripsi Event</label>

    <textarea
        id="description"
        name="description"
        rows="5"
        placeholder="Jelaskan informasi event"
    >{{ old('description', $event->description ?? '') }}</textarea>

    @error('description')
        <small class="form-error">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="location">Lokasi</label>

    <input
        type="text"
        id="location"
        name="location"
        value="{{ old('location', $event->location ?? '') }}"
        placeholder="Masukkan lokasi event"
    >

    @error('location')
        <small class="form-error">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="event_date">Tanggal dan Waktu Event</label>

    <input
        type="datetime-local"
        id="event_date"
        name="event_date"
        value="{{ old(
            'event_date',
            isset($event) ? $event->event_date->format('Y-m-d\TH:i') : ''
        ) }}"
        required
    >

    @error('event_date')
        <small class="form-error">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="status">Status Publikasi</label>

    <select id="status" name="status" required>
        <option
            value="draft"
            @selected(old('status', $event->status ?? 'draft') === 'draft')
        >
            Draft
        </option>

        <option
            value="published"
            @selected(old('status', $event->status ?? 'draft') === 'published')
        >
            Dipublikasikan
        </option>
    </select>

    @error('status')
        <small class="form-error">{{ $message }}</small>
    @enderror
</div>

<div class="form-actions">
    <a href="{{ route('admin.events.index') }}" class="admin-button-secondary">
        Batal
    </a>

    <button type="submit" class="admin-button">
        {{ $buttonLabel ?? 'Simpan Event' }}
    </button>
</div>