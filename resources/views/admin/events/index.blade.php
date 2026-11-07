@extends('admin.layouts.app')

@section('title', 'Upcoming Agenda / Event')
@section('page-title', 'Upcoming Agenda / Event')

@section('content')
    <div class="content-heading">
        <h2>Kelola Agenda / Event</h2>
        <p>Tambah, edit, dan atur publikasi agenda Sekolah Riset Akshara.</p>
    </div>

    @if (session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert-error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="content-card">
        <div class="event-toolbar">
            <h3>Daftar Event</h3>

            <a href="{{ route('admin.events.create') }}" class="admin-button">
                + Tambah Event
            </a>
        </div>

        <div class="table-wrapper">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Event</th>
                        <th>Tanggal</th>
                        <th>Lokasi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($events as $event)
                        <tr>
                            <td>{{ $events->firstItem() + $loop->index }}</td>

                            <td>
                                <strong>{{ $event->title }}</strong>
                            </td>

                            <td>
                                {{ $event->event_date->format('d M Y, H:i') }}
                            </td>

                            <td>{{ $event->location ?: '-' }}</td>

                            <td>
                                <span class="event-status {{ $event->status }}">
                                    {{ $event->status === 'published' ? 'Dipublikasikan' : 'Draft' }}
                                </span>
                            </td>

                            <td>
                                <div class="event-actions">
                                    <a
                                        href="{{ route('admin.events.edit', $event) }}"
                                        class="action-edit"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('admin.events.destroy', $event) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus event ini?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="action-delete">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="table-empty">
                                Belum ada event. Silakan tambahkan event baru.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination-wrapper">
            {{ $events->links() }}
        </div>
    </div>
@endsection