@extends('admin.layouts.app')

@section('title', 'Edit Event')
@section('page-title', 'Edit Event')

@section('content')
    <div class="content-heading">
        <h2>Edit Event</h2>
        <p>Perbarui informasi agenda atau event.</p>
    </div>

    <div class="content-card">
        <form
            action="{{ route('admin.events.update', $event) }}"
            method="POST"
        >
            @csrf
            @method('PUT')

            @include('admin.events._form', [
                'event' => $event,
                'buttonLabel' => 'Simpan Perubahan'
            ])
        </form>
    </div>
@endsection