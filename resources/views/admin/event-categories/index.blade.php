@extends('admin.layouts.app')
@section('title', 'Kategori Peserta')
@section('page-title', 'Kategori Peserta')
@section('content')
<div class="content-heading">
    <h2>Kategori Peserta</h2>
    <p>Atur kategori dan harga untuk event: <strong>{{ $event->title }}</strong>.</p>
</div>
@if (session('success'))
    <div class="alert-success">{{ session('success') }}</div>
@endif
@if ($errors->any())
    <div class="alert-error"><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
@endif
<div class="content-card">
    <h3>Tambah Kategori</h3>
    <form action="{{ route('admin.events.categories.store', $event) }}" method="POST">
        @csrf
        <div class="form-group"><label>Nama Kategori</label><input name="name" required maxlength="100" placeholder="Contoh: Mahasiswa"></div>
        <div class="form-group"><label>Harga Normal (Rp)</label><input type="number" name="normal_price" min="0" step="0.01" required></div>
        <div class="form-group"><label>Harga Early Bird (Rp) - Opsional</label><input type="number" name="early_bird_price" min="0" step="0.01"></div>
        <div class="form-group"><label>Mulai Early Bird</label><input type="datetime-local" name="early_bird_start"></div>
        <div class="form-group"><label>Akhir Early Bird</label><input type="datetime-local" name="early_bird_end"></div>
        <label><input type="checkbox" name="is_active" value="1" checked> Aktif untuk pendaftaran</label>
        <button type="submit" class="admin-button">Tambah Kategori</button>
    </form>
</div>
<div class="content-card">
    <h3>Daftar Kategori</h3>
    @forelse ($categories as $category)
    <div class="content-card" style="margin-top:16px">
        <form action="{{ route('admin.events.categories.update', [$event, $category]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group"><label>Nama Kategori</label><input name="name" value="{{ $category->name }}" required maxlength="100"></div>
            <div class="form-group"><label>Harga Normal (Rp)</label><input type="number" name="normal_price" min="0" step="0.01" value="{{ $category->normal_price }}" required></div>
            <div class="form-group"><label>Harga Early Bird (Rp)</label><input type="number" name="early_bird_price" min="0" step="0.01" value="{{ $category->early_bird_price }}"></div>
            <div class="form-group"><label>Mulai Early Bird</label><input type="datetime-local" name="early_bird_start" value="{{ $category->early_bird_start?->format('Y-m-d\\TH:i') }}"></div>
            <div class="form-group"><label>Akhir Early Bird</label><input type="datetime-local" name="early_bird_end" value="{{ $category->early_bird_end?->format('Y-m-d\\TH:i') }}"></div>
            <label><input type="checkbox" name="is_active" value="1" @checked($category->is_active)> Aktif untuk pendaftaran</label>
            <button type="submit" class="admin-button">Simpan Perubahan</button>
        </form>
        <form action="{{ route('admin.events.categories.destroy', [$event, $category]) }}" method="POST" style="margin-top:10px" onsubmit="return confirm('Hapus kategori ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="action-delete">Hapus Kategori</button>
        </form>
    </div>
    @empty
        <p>Belum ada kategori untuk event ini.</p>
    @endforelse
</div>
<a href="{{ route('admin.events.index') }}" class="admin-button-secondary">Kembali ke Daftar Event</a>
@endsection
