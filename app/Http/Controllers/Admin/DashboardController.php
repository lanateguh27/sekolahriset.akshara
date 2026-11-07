<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Participant;

class DashboardController extends Controller
{
    public function index()
    {
        // Menghitung seluruh peserta
        $totalPeserta = Participant::count();

        // Menghitung peserta yang belum terverifikasi
        $pesertaBelumVerifikasi = Participant::where(
            'status',
            'pending'
        )->count();

        // Menghitung peserta yang sudah terverifikasi
        $pesertaTerverifikasi = Participant::where(
            'status',
            'verified'
        )->count();

        // Menghitung seluruh event
        $totalEvent = Event::count();

        return view('admin.dashboard', compact(
            'totalPeserta',
            'pesertaBelumVerifikasi',
            'pesertaTerverifikasi',
            'totalEvent'
        ));
    }
}