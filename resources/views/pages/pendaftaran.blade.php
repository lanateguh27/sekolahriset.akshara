
@extends('layouts.app')

@section('content')

<section class="registration-section">

    <div class="registration-container">

        {{-- Header Form --}}
        <div class="registration-header">

            <span class="registration-eyebrow">
                SEKOLAH RISET AKSHARA
            </span>

            <h1>
                Form Pendaftaran
                <span>Peserta</span>
            </h1>

            <p>
                Lengkapi data diri dan informasi pendaftaran
                untuk mengikuti program Sekolah Riset Akshara.
            </p>

        </div>

        {{-- Pesan Berhasil --}}
        @if (session('success'))

            <div class="registration-success">
                {{ session('success') }}
            </div>

        @endif

        {{-- Form Pendaftaran --}}
        <div class="registration-card">

            <form
                action="{{ route('pendaftaran.store') }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf

                {{-- Nama --}}
                <div class="registration-field">

                    <label for="name">
                        Nama Lengkap
                        <span>*</span>
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        placeholder="Masukkan nama lengkap"
                        value="{{ old('name') }}"
                        required
                    >

                    @error('name')
                        <small class="registration-error">
                            {{ $message }}
                        </small>
                    @enderror

                </div>

                {{-- Acara / Agenda yang Diikuti --}}
                <div class="registration-field">

                    <label for="event_id">
                        Acara / Agenda yang Diikuti
                        <span>*</span>
                    </label>

                    <select
                        id="event_id"
                        name="event_id"
                        required
                    >

                        <option value="">
                            Pilih acara atau agenda
                        </option>

                        {{-- Pilihan event dari database --}}
                        @foreach ($events as $event)
                            <option
                                value="{{ $event->id }}"
                                {{ old('event_id', request('event_id')) == $event->id ? 'selected' : '' }}
                            >
                                {{ $event->title }}
                            </option>
                        @endforeach

                    </select>

                </div>

                {{-- Kategori Peserta sesuai event --}}
                <div class="registration-field" id="categoryField" hidden>
                    <label for="event_category_id">
                        Kategori Peserta
                        <span>*</span>
                    </label>
                    <select id="event_category_id" name="event_category_id" required disabled>
                        <option value="">Pilih kategori peserta</option>
                    </select>
                    <small id="categoryMessage" class="registration-error" aria-live="polite"></small>
                    @error('event_category_id')
                        <small class="registration-error">{{ $message }}</small>
                    @enderror
                    <div id="categoryPrice" class="registration-note" hidden></div>
                </div>

                {{-- Asal Instansi --}}
                <div class="registration-field">

                    <label for="institution">
                        Asal Instansi
                        <span>*</span>
                    </label>

                    <input
                        type="text"
                        id="institution"
                        name="institution"
                        placeholder="Masukkan nama sekolah, kampus, atau instansi"
                        value="{{ old('institution') }}"
                        required
                    >

                    @error('institution')
                        <small class="registration-error">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                {{-- Asal Kota --}}
                <div class="registration-field">

                    <label for="city">
                        Asal Kota
                        <span>*</span>
                    </label>

                    <input
                        type="text"
                        id="city"
                        name="city"
                        placeholder="Masukkan asal kota"
                        value="{{ old('city') }}"
                        required
                    >

                    @error('city')
                        <small class="registration-error">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                {{-- Nomor HP --}}
                <div class="registration-field">

                    <label for="phone">
                        Nomor HP / WhatsApp
                        <span>*</span>
                    </label>

                    <input
                        type="tel"
                        id="phone"
                        name="phone"
                        placeholder="Contoh: 081234567890"
                        value="{{ old('phone') }}"
                        required
                    >

                    @error('phone')
                        <small class="registration-error">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                {{-- Email --}}
                <div class="registration-field">

                    <label for="email">
                        Email
                        <span>*</span>
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="nama@email.com"
                        value="{{ old('email') }}"
                        required
                    >

                    @error('email')
                        <small class="registration-error">
                            {{ $message }}
                        </small>
                    @enderror

                </div>

                
                {{-- Upload KTM --}}
                <div class="registration-field">

                    <label for="ktm">
                        Kartu Tanda Mahasiswa (KTM)
                        <span>*</span>
                    </label>

                    <div class="registration-upload">

                        <input
                            type="file"
                            id="ktm"
                            name="ktm"
                            accept="image/jpeg,image/png,image/webp"
                            required
                        >

                        <p>
                            Unggah foto KTM yang masih berlaku dalam format
                            JPG, PNG, atau WebP. Maksimal 2 MB.
                        </p>

                    </div>

                </div>


                {{-- Bukti Pembayaran --}}
                <div class="registration-field">

                    <label for="payment_proof">
                        Bukti Pembayaran
                        <span>*</span>
                    </label>

                    <div class="registration-upload">

                        <input
                            type="file"
                            id="payment_proof"
                            name="payment_proof"
                            accept="image/jpeg,image/png,image/webp"
                            required
                        >

                        <p>
                            Unggah bukti pembayaran dalam format JPG,
                            PNG, atau WebP. Maksimal 2 MB.
                        </p>

                    </div>

                    @error('payment_proof')
                        <small class="registration-error">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                {{-- Sumber Informasi --}}
                <div class="registration-field">

                    <label for="information_source">
                        Tahu Info Ini dari Mana?
                        <span>*</span>
                    </label>

                    <select
                        id="information_source"
                        name="information_source"
                        required
                    >

                        <option value="">
                            Pilih sumber informasi
                        </option>

                        <option value="Instagram"
                            {{ old('information_source') == 'Instagram' ? 'selected' : '' }}>
                            Instagram
                        </option>

                        <option value="TikTok"
                            {{ old('information_source') == 'TikTok' ? 'selected' : '' }}>
                            TikTok
                        </option>

                        <option value="WhatsApp"
                            {{ old('information_source') == 'WhatsApp' ? 'selected' : '' }}>
                            WhatsApp
                        </option>

                        <option value="Website"
                            {{ old('information_source') == 'Website' ? 'selected' : '' }}>
                            Website
                        </option>

                        <option value="Teman atau kerabat"
                            {{ old('information_source') == 'Teman atau kerabat' ? 'selected' : '' }}>
                            Teman atau kerabat
                        </option>

                        <option value="Sekolah atau kampus"
                            {{ old('information_source') == 'Sekolah atau kampus' ? 'selected' : '' }}>
                            Sekolah atau kampus
                        </option>

                        <option value="Lainnya"
                            {{ old('information_source') == 'Lainnya' ? 'selected' : '' }}>
                            Lainnya
                        </option>

                    </select>

                    @error('information_source')
                        <small class="registration-error">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                {{-- Persetujuan --}}
                <div class="registration-note">

                    <p>
                        Pastikan seluruh data yang kamu masukkan
                        sudah benar sebelum mengirimkan pendaftaran.
                    </p>

                </div>


                {{-- Tombol Submit --}}
                <button
                    type="submit"
                    class="registration-submit"
                    id="registrationSubmit"
                    disabled
                >
                    Kirim Pendaftaran
                </button>

            </form>

        </div>

        {{-- Kembali ke Beranda --}}
        <div class="registration-back">

            <a href="{{ url('/') }}">
                ← Kembali ke Beranda
            </a>

        </div>

    </div>

</section>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const eventSelect = document.getElementById('event_id');
    const categoryField = document.getElementById('categoryField');
    const categorySelect = document.getElementById('event_category_id');
    const categoryMessage = document.getElementById('categoryMessage');
    const categoryPrice = document.getElementById('categoryPrice');
    const submitButton = document.getElementById('registrationSubmit');
    const oldCategoryId = @json(old('event_category_id'));

    function formatRupiah(amount) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            maximumFractionDigits: 0
        }).format(amount);
    }

    function resetCategory(message) {
        categorySelect.innerHTML = '<option value="">Pilih kategori peserta</option>';
        categorySelect.disabled = true;
        categoryMessage.textContent = message || '';
        categoryPrice.hidden = true;
        categoryPrice.textContent = '';
        submitButton.disabled = true;
    }

    async function loadCategories(eventId, selectedCategoryId = null) {
        categoryField.hidden = !eventId;
        resetCategory(eventId ? 'Memuat kategori...' : '');

        if (!eventId) return;

        try {
            const response = await fetch('/events/' + encodeURIComponent(eventId) + '/categories', {
                headers: { 'Accept': 'application/json' }
            });

            if (!response.ok) throw new Error('Kategori tidak dapat dimuat.');

            const categories = await response.json();

            if (!categories.length) {
                resetCategory('Belum ada kategori aktif untuk event ini. Silakan hubungi penyelenggara.');
                return;
            }

            categories.forEach(function (category) {
                const option = document.createElement('option');
                option.value = category.id;
                option.textContent = category.name;
                option.dataset.price = category.price;
                option.dataset.normalPrice = category.normal_price;
                option.dataset.priceType = category.price_type;
                if (String(category.id) === String(selectedCategoryId)) option.selected = true;
                categorySelect.appendChild(option);
            });

            categorySelect.disabled = false;
            categoryMessage.textContent = 'Pilih satu kategori yang sesuai.';
            updatePrice();
        } catch (error) {
            resetCategory('Terjadi kendala saat memuat kategori. Silakan pilih ulang event atau muat ulang halaman.');
        }
    }

    function updatePrice() {
        const option = categorySelect.options[categorySelect.selectedIndex];
        if (!option || !option.value) {
            categoryPrice.hidden = true;
            submitButton.disabled = true;
            return;
        }

        const price = Number(option.dataset.price);
        const normalPrice = Number(option.dataset.normalPrice);
        const isEarlyBird = option.dataset.priceType === 'early_bird';

        categoryPrice.hidden = false;
        categoryPrice.innerHTML = isEarlyBird
            ? '<strong>Harga normal:</strong> <s>' + formatRupiah(normalPrice) + '</s><br><strong>Harga Early Bird:</strong> ' + formatRupiah(price)
            : '<strong>Harga pendaftaran:</strong> ' + formatRupiah(price);

        submitButton.disabled = false;
    }

    eventSelect.addEventListener('change', function () {
        loadCategories(this.value);
    });

    categorySelect.addEventListener('change', updatePrice);

    if (eventSelect.value) {
        loadCategories(eventSelect.value, oldCategoryId);
    } else {
        resetCategory('');
    }
});
</script>

@endsection
