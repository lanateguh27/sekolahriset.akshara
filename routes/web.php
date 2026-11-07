<?php

use Illuminate\\Support\\Facades\\Route;
use Illuminate\\Support\\Facades\\Storage;
use App\\Http\\Controllers\\ParticipantController;
use App\\Http\\Controllers\\Admin\\AuthController;
use App\\Http\\Controllers\\Admin\\DashboardController;
use App\\Http\\Controllers\\Admin\\EventController;
use App\\Http\\Controllers\\Admin\\ParticipantController as AdminParticipantController;
use App\\Models\\Event;
use App\\Models\\Participant;

/*
|--------------------------------------------------------------------------
| Halaman Utama
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    $events = Event::where('status', 'published')
        ->orderBy('event_date')
        ->get();

    return view('pages.home', compact('events'));
});

/*
|--------------------------------------------------------------------------
| Pendaftaran Peserta
|--------------------------------------------------------------------------
*/

Route::get('/pendaftaran', [ParticipantController::class, 'create'])
    ->name('pendaftaran.create');

Route::post('/pendaftaran', [ParticipantController::class, 'store'])
    ->name('pendaftaran.store');

/*
|--------------------------------------------------------------------------
| Route Login Admin
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/admin/login', [AuthController::class, 'login'])
        ->name('admin.login.submit');
});

/*
|--------------------------------------------------------------------------
| Route Admin yang Membutuhkan Login
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('admin.logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    Route::resource('events', EventController::class)
        ->names('admin.events');

    Route::get('/participants', [AdminParticipantController::class, 'index'])
        ->name('admin.participants.index');

    Route::patch('/participants/{participant}/verify', [AdminParticipantController::class, 'verify'])
        ->name('admin.participants.verify');

    Route::delete('/participants/{participant}', [AdminParticipantController::class, 'destroy'])
        ->name('admin.participants.destroy');

    /*
    |--------------------------------------------------------------------------
    | Menampilkan Bukti Pembayaran
    |--------------------------------------------------------------------------
    */

    Route::get('/participants/{participant}/payment-proof', function (Participant $participant) {
        abort_if(empty($participant->payment_proof), 404);

        $disk = Storage::disk('local');
        $file = $participant->payment_proof;

        abort_unless($disk->exists($file), 404);

        return $disk->response(
            $file,
            basename($file),
            [
                'Content-Type' => $disk->mimeType($file) ?: 'application/octet-stream',
                'X-Content-Type-Options' => 'nosniff',
            ],
            'inline'
        );
    })->name('admin.participants.payment-proof');

    /*
    |--------------------------------------------------------------------------
    | Menampilkan Foto KTM
    |--------------------------------------------------------------------------
    */

    Route::get('/participants/{participant}/ktm', function (Participant $participant) {
        abort_if(empty($participant->ktm_path), 404);

        $disk = Storage::disk('local');
        $file = $participant->ktm_path;

        abort_unless($disk->exists($file), 404);

        return $disk->response(
            $file,
            basename($file),
            [
                'Content-Type' => $disk->mimeType($file) ?: 'application/octet-stream',
                'X-Content-Type-Options' => 'nosniff',
            ],
            'inline'
        );
    })->name('admin.participants.ktm');
});
