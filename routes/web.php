
<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\ParticipantController as AdminParticipantController;
use App\Models\Event;
use App\Models\Participant;

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

// Halaman pendaftaran peserta
Route::get('/pendaftaran', [ParticipantController::class, 'create'])
    ->name('pendaftaran.create');

// Proses penyimpanan pendaftaran
Route::post('/pendaftaran', [ParticipantController::class, 'store'])
    ->name('pendaftaran.store');

/*
|--------------------------------------------------------------------------
| Route Login Admin
|--------------------------------------------------------------------------
*/

// Halaman login hanya bisa diakses ketika belum login
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

    // Logout admin
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('admin.logout');

    // Dashboard admin
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    // Manajemen acara
    Route::resource('events', EventController::class)
        ->names('admin.events');

    /*
    |--------------------------------------------------------------------------
    | Manajemen Peserta
    |--------------------------------------------------------------------------
    */

    // Menampilkan daftar peserta
    Route::get('/participants', [AdminParticipantController::class, 'index'])
        ->name('admin.participants.index');

    // Verifikasi peserta
    Route::patch('/participants/{participant}/verify', [AdminParticipantController::class, 'verify'])
        ->name('admin.participants.verify');

    // Menghapus peserta
    Route::delete('/participants/{participant}', [AdminParticipantController::class, 'destroy'])
        ->name('admin.participants.destroy');

    /*
|--------------------------------------------------------------------------
| Menampilkan Bukti Pembayaran
|--------------------------------------------------------------------------
*/

Route::get('/participants/{participant}/payment-proof', function (Participant $participant) {
    abort_if(empty($participant->payment_proof), 404);

    abort_unless(
        Storage::disk('local')->exists($participant->payment_proof),
        404
    );

    return Storage::disk('local')->response(
        $participant->payment_proof,
        basename($participant->payment_proof),
        [
            'Content-Type' => 'image/png',
            'Content-Disposition' => 'inline',
        ]
    );
})->name('admin.participants.payment-proof');


/*
|--------------------------------------------------------------------------
| Menampilkan Foto KTM
|--------------------------------------------------------------------------
*/

Route::get('/participants/{participant}/ktm', function (Participant $participant) {
    abort_if(empty($participant->ktm_path), 404);

    $path = Storage::disk('local')->path($participant->ktm_path);

    abort_unless(file_exists($path), 404);

    return response()->file($path);
})->name('admin.participants.ktm');

Route::get('/test-ktm', function () {
    $path = storage_path(
        'app/private/ktm/FhI8Opkz4wIjEC6oWrlq6uBOWLr3Y6nPtvCBZLBs.png'
    );

    abort_unless(file_exists($path), 404);

    $gambar = file_get_contents($path);
    $base64 = base64_encode($gambar);

    return response(
        '<!DOCTYPE html>
        <html>
        <body>
            <h3>Tes Gambar KTM</h3>
            <img src="data:image/png;base64,' . $base64 . '">
        </body>
        </html>'
    )->header('Content-Type', 'text/html');
});
});
