@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
    <div class="content-heading">
        <h2>Selamat Datang, {{ auth()->user()->name }}!</h2>
        <p>
            Berikut ringkasan data pendaftaran peserta
            Sekolah Riset Akshara.
        </p>
    </div>

    <div class="dashboard-stats">
        <div class="stat-card">
            <div class="stat-card-icon purple">👥</div>
            <h3>Jumlah Peserta</h3>
            <p>{{ number_format($totalPeserta) }}</p>
        </div>

        <div class="stat-card">
            <div class="stat-card-icon orange">⏳</div>
            <h3>Belum Terverifikasi</h3>
            <p>{{ number_format($pesertaBelumVerifikasi) }}</p>
        </div>

        <div class="stat-card">
            <div class="stat-card-icon green">✓</div>
            <h3>Sudah Terverifikasi</h3>
            <p>{{ number_format($pesertaTerverifikasi) }}</p>
        </div>

        <div class="stat-card">
            <div class="stat-card-icon blue">📅</div>
            <h3>Jumlah Event</h3>
            <p>{{ number_format($totalEvent) }}</p>
        </div>
    </div>
@endsection