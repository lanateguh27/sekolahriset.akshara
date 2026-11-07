@extends('admin.layouts.app')

@section('title', 'Tambah Event')
@section('page-title', 'Tambah Event')

@section('content')
    <div class="content-heading">
        <h2>Tambah Event Baru</h2>
        <p>Masukkan informasi agenda atau event yang akan diselenggarakan.</p>
    </div>

    <div class="content-card">
        <form
                action="{{ route('admin.events.store') }}"
                method="POST"
                enctype="multipart/form-data"
            >
                @csrf

                @include('admin.events._form', [
                    'buttonLabel' => 'Simpan Event'
                ])
            </form>
    </div>
@endsection