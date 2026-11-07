<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Admin') | Sekolah Riset Akshara</title>

    {{-- Font Montserrat --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- CSS khusus halaman admin --}}
    @vite('resources/css/admin.css')

    @stack('styles')
</head>

<body>
    {{-- Sidebar navigasi admin --}}
    <aside class="admin-sidebar" id="adminSidebar">
        <div class="sidebar-brand">
            {{-- Sesuaikan path logo jika nama file berbeda --}}
            <img src="{{ asset('images/logo/logo-sekolahriset.png') }}" alt="Logo Akshara">

            <div class="sidebar-brand-text">
                <h2>Sekolah Riset</h2>
                <p>Admin Panel</p>
            </div>
        </div>

        <nav class="sidebar-menu">
            <a
                href="{{ route('admin.dashboard') }}"
                class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
            >
                <span class="sidebar-icon">▦</span>
                <span>Dashboard</span>
            </a>
        </nav>

        <div class="sidebar-divider"></div>

        <p class="sidebar-section">Kelola Konten</p>

        <nav class="sidebar-menu">
            {{-- Menu ini akan dihubungkan ke route CRUD selanjutnya --}}
            <a href="{{ route('admin.events.index') }}" class="sidebar-link {{ request()->routeIs('admin.events.*') ? 'active' : '' }}">
                <span class="sidebar-icon">▣</span>
                <span>Upcoming Agenda / Event</span>
            </a>

            <a href="#" class="sidebar-link">
                <span class="sidebar-icon">◇</span>
                <span>Logo Mitra</span>
            </a>

            <a href="#" class="sidebar-link">
                <span class="sidebar-icon">❝</span>
                <span>Testimoni</span>
            </a>

            <a href="#" class="sidebar-link">
                <span class="sidebar-icon">▧</span>
                <span>Galeri</span>
            </a>

            <a href="#" class="sidebar-link">
                <span class="sidebar-icon">?</span>
                <span>FAQ</span>
            </a>
        </nav>

        <div class="sidebar-divider"></div>

        <p class="sidebar-section">Kelola Peserta</p>   

        <nav class="sidebar-menu">
            <a href="{{ route('admin.participants.index') }}" class="{{ request()->routeIs('admin.participants.*') ? 'active' : '' }}">
                <span class="sidebar-icon">◷</span>
                <span>Kelola Peserta</span>
            </a>

            <!-- <a href="#" class="sidebar-link">
                <span class="sidebar-icon">✓</span>
                <span>Sudah Terverifikasi</span>
            </a> -->
        </nav>

        <div class="sidebar-bottom">
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf

                <button type="submit" class="sidebar-logout">
                    <span class="sidebar-icon">↪</span>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    {{-- Overlay ketika sidebar dibuka pada layar kecil --}}
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    {{-- Area utama halaman --}}
    <div class="admin-main">
        <header class="admin-header">
            <div class="header-left">
                <button
                    type="button"
                    class="sidebar-toggle"
                    id="sidebarToggle"
                    aria-label="Buka navigasi"
                >
                    ☰
                </button>

                <div class="header-title">
                    <h1>@yield('page-title', 'Dashboard')</h1>
                    <p>Panel Administrasi Sekolah Riset Akshara</p>
                </div>
            </div>

            <div class="header-user">
                <div class="header-avatar">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>

                <div class="header-user-info">
                    <strong>{{ auth()->user()->name ?? 'Administrator' }}</strong>
                    <span>Administrator</span>
                </div>
            </div>
        </header>

        <main class="admin-content">
            @yield('content')
        </main>
    </div>

    {{-- JavaScript untuk sidebar mobile --}}
    <script>
        const sidebar = document.getElementById('adminSidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        function toggleSidebar() {
            sidebar.classList.toggle('show');
            sidebarOverlay.classList.toggle('show');
        }

        sidebarToggle.addEventListener('click', toggleSidebar);
        sidebarOverlay.addEventListener('click', toggleSidebar);
    </script>

    @stack('scripts')
</body>
</html>