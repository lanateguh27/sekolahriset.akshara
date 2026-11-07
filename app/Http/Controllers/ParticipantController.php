<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ParticipantController extends Controller
{
    // Menampilkan halaman form pendaftaran
    public function create()
    {
        $events = Event::where('status', 'published')
            ->orderBy('event_date')
            ->get();

        return view('pages.pendaftaran', compact('events'));
    }

    // Mengambil kategori aktif untuk event yang dipilih
    public function categories(Event $event)
    {
        abort_unless($event->status === 'published', 404);

        $now = now();
        $categories = $event->categories()
            ->where('is_active', true)
            ->orderBy('name')
            ->get()
            ->map(function ($category) use ($now) {
                $earlyBirdActive = $category->early_bird_price !== null
                    && $category->early_bird_start !== null
                    && $category->early_bird_end !== null
                    && $now->betweenIncluded($category->early_bird_start, $category->early_bird_end);

                return [
                    'id' => $category->id,
                    'name' => $category->name,
                    'normal_price' => (float) $category->normal_price,
                    'price' => (float) ($earlyBirdActive ? $category->early_bird_price : $category->normal_price),
                    'price_type' => $earlyBirdActive ? 'early_bird' : 'normal',
                ];
            });

        return response()->json($categories);
    }

    // Menyimpan pendaftaran peserta
    public function store(Request $request)
    {
        // Validasi data yang dikirim oleh peserta
        $validated = $request->validate([
            'event_id' => [
                'required',
                'integer',
                Rule::exists('events', 'id')
                    ->where('status', 'published'),
            ],

            'event_category_id' => [
                'required',
                'integer',
                Rule::exists('event_categories', 'id')
                    ->where('event_id', $request->input('event_id'))
                    ->where('is_active', true),
            ],

            'name' => [
                'required',
                'string',
                'max:150',
            ],

            'institution' => [
                'required',
                'string',
                'max:150',
            ],

            'city' => [
                'required',
                'string',
                'max:100',
            ],

            'phone' => [
                'required',
                'string',
                'max:20',
            ],

            'email' => [
                'required',
                'email',
                'max:150',
                'unique:participants,email',
            ],

            'payment_proof' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'ktm' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'information_source' => [
                'required',
                Rule::in([
                    'Instagram',
                    'TikTok',
                    'WhatsApp',
                    'Website',
                    'Teman atau kerabat',
                    'Sekolah atau kampus',
                    'Lainnya',
                ]),
            ],
        ], [
            'event_id.required' => 'Acara wajib dipilih.',
            'event_id.exists' => 'Acara yang dipilih tidak tersedia.',
            'event_category_id.required' => 'Kategori peserta wajib dipilih.',
            'event_category_id.exists' => 'Kategori tidak tersedia untuk acara yang dipilih.',

            'name.required' => 'Nama peserta wajib diisi.',
            'institution.required' => 'Asal instansi wajib diisi.',
            'city.required' => 'Asal kota wajib diisi.',
            'phone.required' => 'Nomor HP wajib diisi.',

            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah pernah digunakan untuk mendaftar.',

            'payment_proof.required' => 'Bukti pembayaran wajib diunggah.',
            'payment_proof.image' => 'Bukti pembayaran harus berupa gambar.',
            'payment_proof.mimes' => 'Format gambar harus JPG, PNG, atau WebP.',
            'payment_proof.max' => 'Ukuran gambar maksimal 2 MB.',

            'ktm.required' => 'Foto KTM wajib diunggah.',
            'ktm.image' => 'Foto KTM harus berupa gambar.',
            'ktm.mimes' => 'Format foto KTM harus JPG, PNG, atau WebP.',
            'ktm.max' => 'Ukuran foto KTM maksimal 2 MB.',

            'information_source.required' => 'Sumber informasi wajib dipilih.',
        ]);

        // Harga selalu dihitung ulang di server, bukan memakai nilai dari browser.
        $category = EventCategory::where('id', $validated['event_category_id'])
            ->where('event_id', $validated['event_id'])
            ->where('is_active', true)
            ->firstOrFail();

        $now = now();
        $earlyBirdActive = $category->early_bird_price !== null
            && $category->early_bird_start !== null
            && $category->early_bird_end !== null
            && $now->betweenIncluded($category->early_bird_start, $category->early_bird_end);

        $priceType = $earlyBirdActive ? 'early_bird' : 'normal';
        $priceAmount = $earlyBirdActive ? $category->early_bird_price : $category->normal_price;

        // Simpan bukti pembayaran di disk local
        $paymentPath = $request->file('payment_proof')
            ->store('bukti-pembayaran', 'local');

        // Simpan foto KTM di disk local
        $ktmPath = $request->file('ktm')
            ->store('ktm', 'local');

        // Simpan data peserta dengan status awal pending
        Participant::create([
            'event_id' => $validated['event_id'],
            'event_category_id' => $category->id,
            'category_name_snapshot' => $category->name,
            'price_type' => $priceType,
            'price_amount' => $priceAmount,
            'name' => $validated['name'],
            'institution' => $validated['institution'],
            'city' => $validated['city'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'payment_proof' => $paymentPath,
            'ktm_path' => $ktmPath,
            'information_source' => $validated['information_source'],
            'status' => 'pending',
        ]);

        // Kembali ke halaman pendaftaran dengan pesan berhasil
        return redirect()
            ->route('pendaftaran.create')
            ->with(
                'success',
                'Pendaftaran berhasil dikirim. Silakan menunggu verifikasi admin.'
            );
    }
}
