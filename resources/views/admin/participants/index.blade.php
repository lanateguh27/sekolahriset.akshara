
@extends('admin.layouts.app')

@section('title', 'Kelola Peserta')
@section('page-title', 'Kelola Peserta')

@section('content')
    <div class="content-heading">
        <h2>Kelola Peserta</h2>
        <p>Periksa data pendaftaran dan verifikasi peserta Sekolah Riset Akshara.</p>
    </div>

    @if (session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert-error">{{ session('error') }}</div>
    @endif

    <div class="content-card">
        <div class="event-toolbar">
            <h3>
                {{ $status === 'pending' ? 'Peserta Belum Terverifikasi' : 'Peserta Terverifikasi' }}
            </h3>
        </div>

        <div class="participant-tabs">
            <a href="{{ route('admin.participants.index', ['status' => 'pending']) }}"
                class="{{ $status === 'pending' ? 'active' : '' }}">
                Belum Terverifikasi
            </a>

            <a href="{{ route('admin.participants.index', ['status' => 'verified']) }}"
                class="{{ $status === 'verified' ? 'active' : '' }}">
                Terverifikasi
            </a>
        </div>

        <div class="table-wrapper">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Peserta</th>
                        <th>Asal Instansi</th>
                        <th>Acara</th>
                        <th>Kategori</th>
                        <th>Biaya</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($participants as $participant)
                        <tr>
                            <td>{{ $participants->firstItem() + $loop->index }}</td>
                            <td><strong>{{ $participant->name }}</strong></td>
                            <td>{{ $participant->institution }}</td>
                            <td>{{ $participant->event?->title ?? 'Acara tidak tersedia' }}</td>
                            <td>{{ $participant->category_name_snapshot ?: 'Belum tercatat' }}</td>
                            <td>{{ $participant->price_amount !== null ? 'Rp ' . number_format((float) $participant->price_amount, 0, ',', '.') . ' (' . ($participant->price_type === 'early_bird' ? 'Early Bird' : 'Normal') . ')' : 'Belum tercatat' }}</td>
                            <td>{{ $participant->email }}</td>
                            <td>
                                <span class="event-status {{ $participant->status }}">
                                    {{ $participant->status === 'pending' ? 'Belum Terverifikasi' : 'Terverifikasi' }}
                                </span>
                            </td>
                            <td>
                                <div class="event-actions">
                                    <button
                                        type="button"
                                        class="action-edit"
                                        onclick="openParticipantModal({{ $participant->id }})">
                                        {{ $status === 'pending' ? 'Verifikasi' : 'Detail' }}
                                    </button>

                                    <form
                                        action="{{ route('admin.participants.destroy', $participant) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus peserta ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="action-delete">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="table-empty">
                                Belum ada peserta pada daftar ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination-wrapper">
            {{ $participants->links() }}
        </div>
    </div>

    {{-- Modal detail peserta --}}
    <div id="participantModal" class="participant-modal">
        <div class="participant-modal-content">
            <div class="participant-modal-header">
                <h3>Detail Peserta</h3>

                <button type="button" onclick="closeParticipantModal()">
                    &times;
                </button>
            </div>

            <div id="participantModalBody"></div>

            <div class="participant-modal-actions">
                <button
                    type="button"
                    class="action-edit"
                    onclick="closeParticipantModal()">
                    Tutup
                </button>

                @if ($status === 'pending')
                    <form id="verifyParticipantForm" method="POST">
                        @csrf
                        @method('PATCH')

                        <button type="submit" class="admin-button">
                            Konfirmasi Verifikasi
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>

    {{-- Data peserta dari Laravel --}}
    @php
        $participantData = $participants->getCollection()->map(function ($participant) {
            return [
                'id' => $participant->id,
                'name' => $participant->name,
                'institution' => $participant->institution,
                'city' => $participant->city,
                'phone' => $participant->phone,
                'email' => $participant->email,
                'event' => $participant->event?->title ?? 'Acara tidak tersedia',
                'category' => $participant->category_name_snapshot ?: 'Belum tercatat',
                'price' => $participant->price_amount !== null
                    ? 'Rp ' . number_format((float) $participant->price_amount, 0, ',', '.') . ' (' . ($participant->price_type === 'early_bird' ? 'Early Bird' : 'Normal') . ')'
                    : 'Belum tercatat',
                'information_source' => $participant->information_source,
                'payment_proof_url' => route('admin.participants.payment-proof', $participant),
                'ktm_url' => $participant->ktm_path
                    ? route('admin.participants.ktm', $participant)
                    : null,
                'status' => $participant->status,
            ];
        })->values();
    @endphp

    <script>
        const participants = {{ Illuminate\Support\Js::from($participantData) }};

        function escapeHtml(value) {
            return String(value ?? '').replace(/[&<>"']/g, function (char) {
                return {
                    '&': '&amp;',
                    '<': '&lt;',
                    '>': '&gt;',
                    '"': '&quot;',
                    "'": '&#039;'
                }[char];
            });
        }

       // Membuat tampilan dokumen peserta dengan gambar langsung.
function createParticipantImage(url, altText) {
    const wrapper = document.createElement('div');
    wrapper.className = 'participant-document';

    const title = document.createElement('p');
    const strong = document.createElement('strong');

    strong.textContent = altText + ':';
    title.appendChild(strong);
    wrapper.appendChild(title);

    if (!url) {
        const message = document.createElement('p');
        message.textContent = altText + ' belum tersedia.';
        wrapper.appendChild(message);
        return wrapper;
    }

    // Tampilkan gambar langsung di dalam modal.
    const image = document.createElement('img');

    image.src = url;
    image.alt = altText;
    image.style.display = 'block';
    image.style.maxWidth = '100%';
    image.style.maxHeight = '400px';
    image.style.objectFit = 'contain';
    image.style.marginTop = '10px';

    // Jika gambar gagal dimuat, tampilkan pesan.
    image.onerror = function () {
        const message = document.createElement('p');
        message.textContent = 'Gambar gagal dimuat.';

        image.replaceWith(message);
    };

    wrapper.appendChild(image);

    return wrapper;
}

        window.openParticipantModal = function (id) {
            const participant = participants.find(
                item => Number(item.id) === Number(id)
            );

            if (!participant) {
                console.error('Data peserta tidak ditemukan:', id);
                return;
            }

            const modal = document.getElementById('participantModal');
            const body = document.getElementById('participantModalBody');

            if (!modal || !body) {
                console.error('Elemen modal peserta tidak ditemukan.');
                return;
            }

            // Bersihkan isi modal sebelumnya.
            body.replaceChildren();

            const detail = document.createElement('div');
            detail.className = 'participant-detail';

            const fields = [
                ['Nama', participant.name],
                ['Asal Instansi', participant.institution],
                ['Kota', participant.city],
                ['Nomor HP', participant.phone],
                ['Email', participant.email],
                ['Acara', participant.event],
                ['Kategori Peserta', participant.category],
                ['Biaya Pendaftaran', participant.price],
                ['Sumber Informasi', participant.information_source],
                ['Status', participant.status]
            ];

            fields.forEach(function ([label, value]) {
                const paragraph = document.createElement('p');
                const strong = document.createElement('strong');

                strong.textContent = label + ': ';
                paragraph.appendChild(strong);
                paragraph.appendChild(
                    document.createTextNode(String(value ?? '-'))
                );

                detail.appendChild(paragraph);
            });

            // Tambahkan gambar KTM dan bukti pembayaran.
            detail.appendChild(
                createParticipantImage(participant.ktm_url, 'Foto KTM')
            );

            detail.appendChild(
                createParticipantImage(
                    participant.payment_proof_url,
                    'Bukti Pembayaran'
                )
            );

            body.appendChild(detail);

            @if ($status === 'pending')
                const verifyForm = document.getElementById('verifyParticipantForm');

                if (verifyForm) {
                    verifyForm.action =
                        `/admin/participants/${participant.id}/verify`;
                }
            @endif

            modal.style.display = 'flex';
        };

        window.closeParticipantModal = function () {
            const modal = document.getElementById('participantModal');

            if (modal) {
                modal.style.display = 'none';
            }
        };
    </script>
@endsection
