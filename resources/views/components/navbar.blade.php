
{{-- Navbar Sekolah Riset Akshara --}}
<nav class="navbar">
    <div class="navbar-container">

        {{-- Logo: Ganti nama file sesuai logo milikmu --}}
        <a href="#beranda" class="navbar-logo">
            <img
                src="{{ asset('images/logo/logo-sekolahriset.png') }}"
                alt="Sekolah Riset Akshara"
            >
        </a>

        {{-- Menu Navigasi --}}
        <div class="navbar-menu" id="navbarMenu">
            <a href="#beranda" class="navbar-link">Beranda</a>
            <a href="#tentang" class="navbar-link">Tentang</a>
            <a href="#program" class="navbar-link">Program</a>
            <a href="#faq" class="navbar-link">FAQ</a>
            <a href="#kontak" class="navbar-link">Kontak</a>
        </div>

        {{-- Tombol Daftar Program --}}
        <a href="{{ route('pendaftaran.create') }}"
            class="navbar-cta">
            Daftar Program
        </a>

        {{-- Tombol Menu Mobile --}}
        <button
            type="button"
            class="navbar-toggle"
            id="navbarToggle"
            aria-label="Buka menu navigasi"
            aria-expanded="false"
            aria-controls="navbarMenu"
        >
            <span></span>
            <span></span>
            <span></span>
        </button>

    </div>
</nav>

{{-- JavaScript untuk menu mobile --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggle = document.getElementById('navbarToggle');
        const menu = document.getElementById('navbarMenu');

        if (!toggle || !menu) return;

        toggle.addEventListener('click', function () {
            const isOpen = menu.classList.toggle('active');

            toggle.classList.toggle('active', isOpen);
            toggle.setAttribute('aria-expanded', isOpen);
            toggle.setAttribute(
                'aria-label',
                isOpen ? 'Tutup menu navigasi' : 'Buka menu navigasi'
            );
        });

        // Tutup menu setelah pengunjung memilih navigasi
        menu.querySelectorAll('a').forEach(function (link) {
            link.addEventListener('click', function () {
                menu.classList.remove('active');
                toggle.classList.remove('active');
                toggle.setAttribute('aria-expanded', 'false');
            });
        });
    });
</script>
