
@extends('layouts.app')

@section('title', 'Sekolah Riset Akshara')

@section('content')

    {{-- Section Beranda --}}
    
    {{-- =========================================
        SECTION BERANDA / HERO
        ========================================= --}}

    <section id="beranda" class="hero-section">

        {{-- Gambar background hero --}}
        <img
            src="{{ asset('images/hero-sekolahriset.png') }}"
            alt="Sekolah Riset Akshara"
            class="hero-background"
        >

        {{-- Overlay gelap --}}
        <div class="hero-overlay"></div>

        {{-- Panel konten hero --}}
        <div class="hero-container">

            <div class="hero-content">

                <span class="hero-eyebrow">
                    LEARN. RESEARCH. GROW.
                </span>

                <h1 class="hero-title">
                    Belajar Riset.
                    <br>
                    Menghasilkan Karya.
                </h1>

                <p class="hero-description">
                    Program pelatihan dan pendampingan riset yang dirancang
                    untuk membantu Anda memahami proses penelitian,
                    mengembangkan kompetensi akademik, dan menghasilkan
                    karya yang lebih berkualitas.
                </p>

                <div class="hero-actions">

                    <a href="#program" class="hero-button hero-button-primary">
                        Lihat Program
                    </a>

                    <a href="#tentang" class="hero-button hero-button-outline">
                        Tentang Sekolah Riset Akshara
                    </a>

                </div>

            </div>

        </div>

    </section>



    {{-- Section Tentang --}}
    
    {{-- =========================================
        SECTION TENTANG
        ========================================= --}}

    <section id="tentang" class="about-section">

        <div class="about-container">

            {{-- Bagian pertama: Research Skills --}}
            <div class="about-intro">

                <h2 class="about-main-title">
                    Research Skills That
                    <br>
                    <span>Move You Forward</span>
                </h2>

                <p class="about-description">
                    Riset bukan sekadar menyelesaikan tugas akademik.
                    Riset adalah proses bertanya, menggali informasi,
                    dan mengembangkan gagasan menjadi pengetahuan yang bermakna.
                </p>

                {{-- Kartu keunggulan --}}
                <div class="about-skills-grid">

                    <div class="about-skill-card">
                        <h3>
                            Pemahaman
                            <br>
                            Riset
                        </h3>

                        <p>
                            Memahami dasar, metode, dan tahapan penelitian
                            secara sistematis.
                        </p>
                    </div>

                    <div class="about-skill-card">
                        <h3>
                            Kompetensi
                            <br>
                            Akademik
                        </h3>

                        <p>
                            Mengembangkan keterampilan berpikir kritis
                            dan menulis ilmiah.
                        </p>
                    </div>

                    <div class="about-skill-card">
                        <h3>
                            Pendampingan
                            <br>
                            Terarah
                        </h3>

                        <p>
                            Berlatih bersama panduan yang terarah.
                        </p>
                    </div>

                    <div class="about-skill-card">
                        <h3>
                            Pertumbuhan
                            <br>
                            Berkelanjutan
                        </h3>

                        <p>
                            Memperluas wawasan dan membangun kolaborasi
                            komunitas riset.
                        </p>
                    </div>

                </div>

            </div>

            {{-- Garis pemisah --}}
            <div class="about-divider"></div>

            {{-- Bagian kedua: Pengalaman Riset --}}
            <div class="about-experience">

                <h2 class="about-experience-title">
                    JELAJAHI PENGALAMAN RISET
                </h2>

                <p class="about-experience-description">
                    Temukan pengalaman belajar yang sesuai dengan kebutuhanmu dan
                    <br class="desktop-break">
                    kembangkan potensi melalui berbagai kegiatan riset.
                </p>

                {{-- Kartu pengalaman riset --}}
                <div class="about-experience-grid">

                    <div class="about-experience-card">
                        <h3>Workshop</h3>

                        <p>
                            Pelajari metode dan keterampilan riset melalui sesi
                            praktis yang relevan dan aplikatif.
                        </p>
                    </div>

                    <div class="about-experience-card">
                        <h3>Kuliah Tamu</h3>

                        <p>
                            Perluas wawasan melalui pengalaman dan perspektif
                            dari akademisi serta praktisi.
                        </p>
                    </div>

                    <div class="about-experience-card">
                        <h3>
                            Pendampingan
                            <br>
                            Riset
                        </h3>

                        <p>
                            Kembangkan gagasan dan susun langkah penelitian
                            dengan arahan yang terstruktur.
                        </p>
                    </div>

                    <div class="about-experience-card">
                        <h3>
                            Komunitas &
                            <br>
                            Kolaborasi
                        </h3>

                        <p>
                            Bertukar ide dan membangun jejaring bersama
                            sesama peneliti dan akademisi.
                        </p>
                    </div>

                    <div class="about-experience-card">
                        <h3>
                            Pengembangan
                            <br>
                            Kompetensi
                        </h3>

                        <p>
                            Asah kemampuan berpikir kritis, menulis ilmiah,
                            dan mengembangkan penelitian.
                        </p>
                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- Section Program --}}
    
    {{-- =========================================
        SECTION PROGRAM / UPCOMING AGENDA
        ========================================= --}}

    <section id="program" class="program-section">

        <div class="program-container">

            {{-- Header Section --}}
            <div class="program-header">

                <h2 class="program-title">
                    UPCOMING AGENDA
                </h2>

                <p class="program-description">
                    Perjalanan riset selalu punya ruang untuk berkembang.
                    Jadilah bagian dari pengalaman belajar berikutnya
                    bersama Sekolah Riset Akshara.
                </p>

            </div>

            {{-- Daftar Event dari Database --}}
            <div class="program-grid">

                @forelse ($events as $event)
                    <article class="program-card">

                        {{-- Poster Event --}}
                        <div class="program-poster">
                        @if ($event->poster)
                            <img
                                src="{{ route('events.poster', $event) }}"
                                alt="Poster {{ $event->title }}"
                                class="program-poster-image"
                            >
                        @else
                            <div class="program-poster-placeholder">
                                <span>SEKOLAH RISET AKSHARA</span>
                            </div>
                        @endif
                    </div>

                        {{-- Informasi Event --}}
                        <div class="program-card-content">

                            <h3 class="program-card-title">
                                {{ $event->title }}
                            </h3>

                            <div class="program-meta">

                                {{-- Tanggal --}}
                                <div class="program-meta-item">
                                    <span class="program-meta-icon">
                                        <svg viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2">
                                            <rect x="3" y="5" width="18" height="16" rx="2"/>
                                            <path d="M16 3v4M8 3v4M3 10h18"/>
                                        </svg>
                                    </span>

                                    <span>
                                        {{ $event->event_date->translatedFormat('l, d F Y, H.i') }} WIB
                                    </span>
                                </div>

                                {{-- Lokasi --}}
                                <div class="program-meta-item">
                                    <span class="program-meta-icon">
                                        <svg viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2">
                                            <path d="M20 10c0 5-8 12-8 12S4 15 4 10a8 8 0 1 1 16 0z"/>
                                            <circle cx="12" cy="10" r="2.5"/>
                                        </svg>
                                    </span>

                                    <span>
                                        {{ $event->location ?: 'Informasi lokasi menyusul' }}
                                    </span>
                                </div>

                            </div>

                            {{-- Tombol Daftar --}}
                            <a href="{{ route('pendaftaran.create') }}" class="program-register-button">
                                Daftar Sekarang
                            </a>

                        </div>

                    </article>

                @empty
                    <div class="program-empty">
                        <h3>Belum Ada Agenda</h3>
                        <p>
                            Agenda kegiatan berikutnya akan segera diumumkan.
                        </p>
                    </div>
                @endforelse

            </div>

        </div>

    </section>

    
    {{-- =========================================
        SECTION KENAPA SEKOLAH RISET AKSHARA
        ========================================= --}}

    <section id="kenapa-akshara" class="why-akshara-section">

        <div class="why-akshara-container">

            {{-- Header Section --}}
            <div class="why-akshara-header">

                <h2 class="why-akshara-title">
                    KENAPA SEKOLAH RISET AKSHARA?
                </h2>

                <p class="why-akshara-description">
                    Setiap proses belajar membuka peluang baru untuk mengembangkan kemampuan,
                    memperluas wawasan,<br class="why-desktop-break">
                    dan membawa gagasan lebih jauh
                </p>

            </div>

            {{-- Grid Keunggulan --}}
            <div class="why-akshara-grid">

                {{-- Kartu 1: Belajar Langsung --}}
                <article class="why-akshara-card">

                    <div class="why-akshara-icon">
                        <svg viewBox="0 0 48 48" fill="none"
                            xmlns="http://www.w3.org/2000/svg">

                            <circle cx="24" cy="10" r="7" fill="currentColor"/>

                            <path
                                d="M11 22C15 18 20 17 24 17C28 17 33 18 37 22V38C33 35 28 34 24 34C20 34 15 35 11 38V22Z"
                                fill="currentColor"/>

                            <path
                                d="M5 24C8 24 10 26 10 29V37C7 37 5 35 5 32V24Z"
                                fill="currentColor"/>

                            <path
                                d="M43 24C40 24 38 26 38 29V37C41 37 43 35 43 32V24Z"
                                fill="currentColor"/>

                            <path
                                d="M21 22L24 24L27 22M24 24V32"
                                stroke="white"
                                stroke-width="1.5"
                                stroke-linecap="round"/>

                        </svg>
                    </div>

                    <h3>Belajar Langsung</h3>

                    <p>
                        Dapatkan insight dari dosen, praktisi, dan orang-orang
                        yang berpengalaman di bidangnya.
                    </p>

                </article>

                {{-- Kartu 2: Explore Your Interest --}}
                <article class="why-akshara-card">

                    <div class="why-akshara-icon">
                        <svg viewBox="0 0 48 48" fill="none"
                            xmlns="http://www.w3.org/2000/svg">

                            <path
                                d="M17 30C14 27 12 24 12 20C12 13 17 8 24 8C31 8 36 13 36 20C36 24 34 27 31 30L29 34H19L17 30Z"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linejoin="round"/>

                            <path
                                d="M19 35H29M20 38H28M22 41H26"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"/>

                            <path
                                d="M24 3V5M9 9L11 11M39 9L37 11M5 21H8M40 21H43"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"/>

                            <circle
                                cx="24"
                                cy="20"
                                r="7"
                                stroke="currentColor"
                                stroke-width="1.5"/>

                            <path
                                d="M24 15V20L28 23"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"/>

                            <path
                                d="M31 29L39 37C40 38 40 40 39 41C38 42 36 42 35 41L27 33"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linejoin="round"/>

                        </svg>
                    </div>

                    <h3>Explore Your Interest</h3>

                    <p>
                        Temukan bidang, topik, atau aktivitas yang sesuai
                        dengan rasa ingin tahumu.
                    </p>

                </article>

                {{-- Kartu 3: Create Your Experience --}}
                <article class="why-akshara-card">

                    <div class="why-akshara-icon">
                        <svg viewBox="0 0 48 48" fill="none"
                            xmlns="http://www.w3.org/2000/svg">

                            <path
                                d="M8 34L17 17L23 22L31 10L40 24"
                                stroke="currentColor"
                                stroke-width="1.8"
                                stroke-linecap="round"
                                stroke-linejoin="round"/>

                            <path
                                d="M5 37L17 41L30 36L36 28"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"/>

                            <path
                                d="M20 15L25 6L28 7L25 17M27 19L33 8L36 10L32 22"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"/>

                            <path
                                d="M30 22L35 28L40 29L43 33"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"/>

                            <path
                                d="M13 29L17 33L22 28"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"/>

                        </svg>
                    </div>

                    <h3>Create Your Experience</h3>

                    <p>
                        Jangan hanya menjadi penonton. Ikuti, praktikkan,
                        diskusikan, dan rasakan langsung.
                    </p>

                </article>

                {{-- Kartu 4: Build Your Skills --}}
                <article class="why-akshara-card">

                    <div class="why-akshara-icon">
                        <svg viewBox="0 0 48 48" fill="none"
                            xmlns="http://www.w3.org/2000/svg">

                            <path
                                d="M5 40H43"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"/>

                            <rect
                                x="8"
                                y="28"
                                width="8"
                                height="12"
                                stroke="currentColor"
                                stroke-width="1.5"/>

                            <rect
                                x="20"
                                y="20"
                                width="8"
                                height="20"
                                stroke="currentColor"
                                stroke-width="1.5"/>

                            <rect
                                x="32"
                                y="12"
                                width="8"
                                height="28"
                                stroke="currentColor"
                                stroke-width="1.5"/>

                            <path
                                d="M8 23L15 16L21 19L33 6"
                                stroke="currentColor"
                                stroke-width="1.8"
                                stroke-linecap="round"
                                stroke-linejoin="round"/>

                            <path
                                d="M28 6H33V11"
                                stroke="currentColor"
                                stroke-width="1.8"
                                stroke-linecap="round"
                                stroke-linejoin="round"/>

                            <circle
                                cx="10"
                                cy="8"
                                r="4"
                                stroke="currentColor"
                                stroke-width="1.5"/>

                            <path
                                d="M10 5V8L12 9"
                                stroke="currentColor"
                                stroke-width="1.3"
                                stroke-linecap="round"/>

                        </svg>
                    </div>

                    <h3>Build Your Skills</h3>

                    <p>
                        Ikuti kegiatan yang membantu mengembangkan pengetahuan
                        dan kemampuanmu.
                    </p>

                </article>

                {{-- Kartu 5: Meet New People --}}
                <article class="why-akshara-card">

                    <div class="why-akshara-icon">
                        <svg viewBox="0 0 48 48" fill="none"
                            xmlns="http://www.w3.org/2000/svg">

                            <path
                                d="M6 12C6 7 11 4 17 4C23 4 28 7 28 12C28 17 23 20 17 20C15 20 13 20 11 19L6 22L8 17C7 15 6 14 6 12Z"
                                fill="currentColor"/>

                            <path
                                d="M28 8C33 8 37 11 37 15C37 18 35 20 32 21L34 25L29 22C27 22 25 21 24 20"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linejoin="round"/>

                            <circle cx="12" cy="29" r="5" fill="currentColor"/>
                            <circle cx="24" cy="27" r="6" fill="currentColor"/>
                            <circle cx="36" cy="29" r="5" fill="currentColor"/>

                            <path
                                d="M3 43V40C3 35 7 33 12 33C17 33 20 36 20 40V43H3Z"
                                fill="currentColor"/>

                            <path
                                d="M16 43V39C16 34 20 32 24 32C29 32 32 35 32 39V43H16Z"
                                fill="currentColor"/>

                            <path
                                d="M28 43V40C28 35 32 33 36 33C41 33 45 35 45 40V43H28Z"
                                fill="currentColor"/>

                        </svg>
                    </div>

                    <h3>Meet New People</h3>

                    <p>
                        Meet New People<br>
                        Bangun koneksi dengan mahasiswa, pelajar, komunitas,
                        akademisi, dan praktisi.
                    </p>

                </article>

                {{-- Kartu 6: Get Your E-Certificate --}}
                <article class="why-akshara-card">

                    <div class="why-akshara-icon">
                        <svg viewBox="0 0 48 48" fill="none"
                            xmlns="http://www.w3.org/2000/svg">

                            <path
                                d="M8 5H29L37 13V29"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linejoin="round"/>

                            <path
                                d="M29 5V13H37"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linejoin="round"/>

                            <path
                                d="M13 17H29M13 22H29M13 27H25M13 32H22"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"/>

                            <circle
                                cx="34"
                                cy="30"
                                r="8"
                                stroke="currentColor"
                                stroke-width="1.5"/>

                            <path
                                d="M30 36L29 44L34 41L39 44L38 36"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linejoin="round"/>

                            <path
                                d="M34 25L35.5 28L39 28.5L36.5 31L37 34.5L34 33L31 34.5L31.5 31L29 28.5L32.5 28L34 25Z"
                                fill="currentColor"/>

                        </svg>
                    </div>

                    <h3>Get Your E-Certificate</h3>

                    <p>
                        Untuk kegiatan yang menyediakan sertifikat, kamu dapat
                        memperoleh e-sertifikat sesuai ketentuan masing-masing program.
                    </p>

                </article>

            </div>

        </div>

    </section>

    
{{-- =========================================
     SECTION LOGO MITRA
     ========================================= --}}

<section id="mitra" class="partner-section">

    {{-- Judul Mitra --}}
    <div class="partner-header">
        <h2 class="partner-title">
            Menjalin Mitra Berkolaborasi Bersama
        </h2>
    </div>

    {{-- Strip Logo --}}
    <div class="partner-logo-strip">

        <div class="partner-logo-container">

            {{-- Logo Mitra 1 --}}
            <div class="partner-logo-item">
                <img
                    src="{{ asset('images/logo/logo1.png') }}"
                    alt="Logo Mitra 1"
                >
            </div>

            {{-- Logo Mitra 2 --}}
            <div class="partner-logo-item">
                <img
                    src="{{ asset('images/logo/logo2.png') }}"
                    alt="Logo Mitra 2"
                >
            </div>

            {{-- Logo Mitra 3 --}}
            <div class="partner-logo-item">
                <img
                    src="{{ asset('images/logo/logo3.png') }}"
                    alt="Logo Mitra 3"
                >
            </div>

            {{-- Logo Mitra 4 --}}
            <div class="partner-logo-item">
                <img
                    src="{{ asset('images/logo/logo4.png') }}"
                    alt="Logo Mitra 4"
                >
            </div>

            {{-- Logo Mitra 5 --}}
            <div class="partner-logo-item">
                <img
                    src="{{ asset('images/logo/logo5.png') }}"
                    alt="Logo Mitra 5"
                >
            </div>

        </div>

    </div>

</section>

    
{{-- =========================================
     SECTION TESTIMONI
     ========================================= --}}

<section id="testimoni" class="testimonial-section">

    <div class="testimonial-container">

        {{-- Header Testimoni --}}
        <div class="testimonial-header">

            <h2 class="testimonial-title">
                Mereka Sudah Mengalaminya.
                <span>Sekarang Giliranmu.</span>
            </h2>

            <p class="testimonial-description">
                Dari pengalaman belajar hingga bertemu orang-orang baru,
                lihat bagaimana X-Perience memberi cerita
                <br class="testimonial-desktop-break">
                yang berbeda bagi setiap peserta.
            </p>

        </div>

        {{-- Grid Testimoni --}}
        <div class="testimonial-grid">

            {{-- Testimoni 1 --}}
            <article class="testimonial-card">

                {{-- Bintang --}}
                <div class="testimonial-stars" aria-label="5 dari 5 bintang">
                    ★★★★★
                </div>

                {{-- Isi Testimoni --}}
                <p class="testimonial-quote">
                    "Sebelumnya saya masih merasa kesulitan memahami bagaimana memulai sebuah penelitian. 
                    Setelah mengikuti program Sekolah Riset Akshara, saya jadi lebih memahami tahapan 
                    penelitian, mulai dari menentukan topik hingga menyusun karya ilmiah. Materinya mudah 
                    dipahami dan sangat membantu!"
                </p>

                {{-- Profil Peserta --}}
                <div class="testimonial-profile">

                    <div class="testimonial-avatar">
                        AP
                    </div>

                    <div class="testimonial-profile-info">

                        <h3 class="testimonial-name">
                            Andi Pratama
                        </h3>

                        <p class="testimonial-role">
                            Peserta Program Riset, 2026
                        </p>

                    </div>

                </div>

            </article>

            {{-- Testimoni 2 --}}
            <article class="testimonial-card">

                <div class="testimonial-stars" aria-label="5 dari 5 bintang">
                    ★★★★★
                </div>

                <p class="testimonial-quote">
                    "Pengalaman belajar di Sekolah Riset Akshara sangat menyenangkan. 
                    Tidak hanya mendapatkan materi, tetapi juga bisa berdiskusi dan bertukar 
                    pikiran dengan peserta lain. Saya jadi lebih berani menyampaikan ide 
                    dan mulai mengembangkan penelitian sendiri."
                </p>

                <div class="testimonial-profile">

                    <div class="testimonial-avatar">
                        NS
                    </div>

                    <div class="testimonial-profile-info">

                        <h3 class="testimonial-name">
                            Nadia Safitri
                        </h3>

                        <p class="testimonial-role">
                            Peserta Workshop Riset, 2026
                        </p>

                    </div>

                </div>

            </article>

            {{-- Testimoni 3 --}}
            <article class="testimonial-card">

                <div class="testimonial-stars" aria-label="5 dari 5 bintang">
                    ★★★★★
                </div>

                <p class="testimonial-quote">
                    "Awalnya saya menganggap penelitian itu sulit dan membingungkan. 
                    Namun, melalui pendampingan yang diberikan, saya belajar memahami 
                    prosesnya secara bertahap. Sekarang saya lebih percaya diri untuk 
                    menyusun penelitian dan mengembangkan ide menjadi sebuah karya ilmiah."
                </p>

                <div class="testimonial-profile">

                    <div class="testimonial-avatar">
                        MR
                    </div>

                    <div class="testimonial-profile-info">

                        <h3 class="testimonial-name">
                            Muhammad Rizky
                        </h3>

                        <p class="testimonial-role">
                            Peserta Pendampingan Riset, 2026
                        </p>

                    </div>

                </div>

            </article>

        </div>

    </div>

</section>

    
{{-- =========================================
     SECTION OUR IMPACT
     ========================================= --}}

<section id="our-impact" class="impact-section">

    <div class="impact-container">

        {{-- Judul Section --}}
        <div class="impact-header">
            <h2 class="impact-title">
                Sekolah Riset Akshara In Number
            </h2>
        </div>

        {{-- Grid Statistik --}}
        <div class="impact-grid">

            {{-- Statistik 1 --}}
            <div class="impact-card">

                <h3 class="impact-number">
                    500+
                </h3>

                <p class="impact-label">
                    Learners
                </p>

            </div>

            {{-- Statistik 2 --}}
            <div class="impact-card">

                <h3 class="impact-number">
                    20+
                </h3>

                <p class="impact-label">
                    Programs
                </p>

            </div>

            {{-- Statistik 3 --}}
            <div class="impact-card">

                <h3 class="impact-number">
                    30+
                </h3>

                <p class="impact-label">
                    Research Mentors
                </p>

            </div>

            {{-- Statistik 4 --}}
            <div class="impact-card">

                <h3 class="impact-number">
                    15+
                </h3>

                <p class="impact-label">
                    Institutions
                </p>

            </div>

        </div>

    </div>

</section>

    
{{-- =========================================
     SECTION GALERI
     ========================================= --}}

<section id="galeri" class="gallery-section">

    <div class="gallery-container">

        {{-- Header Galeri --}}
        <div class="gallery-header">

            <span class="gallery-eyebrow">
                Galeri
            </span>

            <h2 class="gallery-title">
                Momen Bersama
            </h2>

            <p class="gallery-description">
                Mengabadikan cerita, kolaborasi, dan pengalaman dalam setiap
                <br class="gallery-desktop-break">
                perjalanan Akshara
            </p>

        </div>

        {{-- Preview Galeri --}}
        <div class="gallery-preview-grid">

            {{-- Foto 1 --}}
            <div class="gallery-preview-item">
                <img
                    src="{{ asset('images/galeri1.jpg') }}"
                    alt="Momen kegiatan Sekolah Riset Akshara"
                    loading="lazy"
                >
            </div>

            {{-- Foto 2 --}}
            <div class="gallery-preview-item">
                <img
                    src="{{ asset('images/galeri2.jpg') }}"
                    alt="Kolaborasi peserta Sekolah Riset Akshara"
                    loading="lazy"
                >
            </div>

            {{-- Foto 3 --}}
            <div class="gallery-preview-item">
                <img
                    src="{{ asset('images/galeri3.jpg') }}"
                    alt="Kegiatan bersama Sekolah Riset Akshara"
                    loading="lazy"
                >
            </div>

        </div>

        {{-- Tombol Lihat Lebih Banyak --}}
        <div class="gallery-button-wrapper">

            <button
                type="button"
                class="gallery-more-button"
                id="galleryOpenButton"
            >
                Lihat Lebih Banyak
            </button>

        </div>

    </div>

</section>


{{-- =========================================
     POPUP GALERI
     ========================================= --}}

<div
    class="gallery-modal"
    id="galleryModal"
    aria-hidden="true"
>

    <div
        class="gallery-modal-content"
        role="dialog"
        aria-modal="true"
        aria-labelledby="galleryModalTitle"
    >

        {{-- Header Popup --}}
        <div class="gallery-modal-header">

            <div>
                <span class="gallery-eyebrow">
                    Galeri
                </span>

                <h2
                    class="gallery-modal-title"
                    id="galleryModalTitle"
                >
                    Momen Bersama
                </h2>
            </div>

            {{-- Tombol Tutup --}}
            <button
                type="button"
                class="gallery-close-button"
                id="galleryCloseButton"
                aria-label="Tutup galeri"
            >
                &times;
            </button>

        </div>

        {{-- Seluruh Foto Galeri --}}
        <div class="gallery-modal-grid">

            <div class="gallery-modal-item">
                <img
                    src="{{ asset('images/galeri/galeri-1.jpg') }}"
                    alt="Momen kegiatan 1"
                    loading="lazy"
                >
            </div>

            <div class="gallery-modal-item">
                <img
                    src="{{ asset('images/galeri/galeri-2.jpg') }}"
                    alt="Momen kegiatan 2"
                    loading="lazy"
                >
            </div>

            <div class="gallery-modal-item">
                <img
                    src="{{ asset('images/galeri/galeri-3.jpg') }}"
                    alt="Momen kegiatan 3"
                    loading="lazy"
                >
            </div>

            <div class="gallery-modal-item">
                <img
                    src="{{ asset('images/galeri/galeri-4.jpg') }}"
                    alt="Momen kegiatan 4"
                    loading="lazy"
                >
            </div>

            <div class="gallery-modal-item">
                <img
                    src="{{ asset('images/galeri/galeri-5.jpg') }}"
                    alt="Momen kegiatan 5"
                    loading="lazy"
                >
            </div>

            <div class="gallery-modal-item">
                <img
                    src="{{ asset('images/galeri/galeri-6.jpg') }}"
                    alt="Momen kegiatan 6"
                    loading="lazy"
                >
            </div>

            <div class="gallery-modal-item">
                <img
                    src="{{ asset('images/galeri/galeri-7.jpg') }}"
                    alt="Momen kegiatan 7"
                    loading="lazy"
                >
            </div>

            <div class="gallery-modal-item">
                <img
                    src="{{ asset('images/galeri/galeri-8.jpg') }}"
                    alt="Momen kegiatan 8"
                    loading="lazy"
                >
            </div>

            <div class="gallery-modal-item">
                <img
                    src="{{ asset('images/galeri/galeri-9.jpg') }}"
                    alt="Momen kegiatan 9"
                    loading="lazy"
                >
            </div>

        </div>

    </div>

</div>


{{-- =========================================
     JAVASCRIPT POPUP GALERI
     ========================================= --}}

<script>
    document.addEventListener('DOMContentLoaded', function () {

        // Mengambil elemen popup dan tombol
        const galleryModal = document.getElementById('galleryModal');
        const galleryOpenButton = document.getElementById('galleryOpenButton');
        const galleryCloseButton = document.getElementById('galleryCloseButton');

        // Membuka popup galeri
        function openGallery() {
            galleryModal.classList.add('active');
            galleryModal.setAttribute('aria-hidden', 'false');

            // Mencegah halaman belakang ikut bergulir
            document.body.style.overflow = 'hidden';

            galleryCloseButton.focus();
        }

        // Menutup popup galeri
        function closeGallery() {
            galleryModal.classList.remove('active');
            galleryModal.setAttribute('aria-hidden', 'true');

            // Mengembalikan scroll halaman
            document.body.style.overflow = '';

            galleryOpenButton.focus();
        }

        // Klik tombol Lihat Lebih Banyak
        galleryOpenButton.addEventListener('click', openGallery);

        // Klik tombol X
        galleryCloseButton.addEventListener('click', closeGallery);

        // Klik area di luar popup
        galleryModal.addEventListener('click', function (event) {

            if (event.target === galleryModal) {
                closeGallery();
            }

        });

        // Tutup popup dengan tombol Escape
        document.addEventListener('keydown', function (event) {

            if (
                event.key === 'Escape' &&
                galleryModal.classList.contains('active')
            ) {
                closeGallery();
            }
        });
    });
</script>


    {{-- Section FAQ --}}
    
{{-- =========================================
     SECTION FAQ
     ========================================= --}}

<section id="faq" class="faq-section">

    <div class="faq-container">

        {{-- Kolom Kiri: Judul dan Gambar --}}
        <div class="faq-left">

            <h2 class="faq-title">
                Frequently Asked
                <br>
                Questions (FAQ)
            </h2>

            {{-- Gambar FAQ --}}
            <div class="faq-image-wrapper">

                <img
                    src="{{ asset('images/faq.png') }}"
                    alt="Frequently Asked Questions Sekolah Riset Akshara"
                    class="faq-image"
                    loading="lazy"
                >

            </div>

        </div>

        {{-- Kolom Kanan: Pertanyaan --}}
        <div class="faq-right">

            {{-- FAQ 1 --}}
            <div class="faq-item">

                <button
                    type="button"
                    class="faq-question"
                    aria-expanded="false"
                >
                    <span>
                        Apa saja program yang tersedia di Akshara?
                    </span>

                    <svg
                        class="faq-arrow"
                        viewBox="0 0 24 24"
                        fill="none"
                        aria-hidden="true"
                    >
                        <path
                            d="M6 9L12 15L18 9"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </svg>
                </button>

                <div class="faq-answer">
                    <div class="faq-answer-content">
                        Sekolah Riset Akshara menyediakan berbagai program
                        pendidikan dan riset yang dirancang untuk
                        mengembangkan kemampuan akademik, keterampilan
                        penelitian, serta pengalaman belajar peserta.
                    </div>
                </div>

            </div>

            {{-- FAQ 2 --}}
            <div class="faq-item">

                <button
                    type="button"
                    class="faq-question"
                    aria-expanded="false"
                >
                    <span>
                        Siapa saja yang dapat mengikuti program Akshara?
                    </span>

                    <svg
                        class="faq-arrow"
                        viewBox="0 0 24 24"
                        fill="none"
                        aria-hidden="true"
                    >
                        <path
                            d="M6 9L12 15L18 9"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </svg>
                </button>

                <div class="faq-answer">
                    <div class="faq-answer-content">
                        Program Akshara dapat diikuti oleh peserta dari
                        berbagai latar belakang pendidikan sesuai dengan
                        persyaratan yang ditentukan pada masing-masing
                        program.
                    </div>
                </div>

            </div>

            {{-- FAQ 3 --}}
            <div class="faq-item">

                <button
                    type="button"
                    class="faq-question"
                    aria-expanded="false"
                >
                    <span>
                        Bagaimana cara mendaftar atau menggunakan layanan Akshara?
                    </span>

                    <svg
                        class="faq-arrow"
                        viewBox="0 0 24 24"
                        fill="none"
                        aria-hidden="true"
                    >
                        <path
                            d="M6 9L12 15L18 9"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </svg>
                </button>

                <div class="faq-answer">
                    <div class="faq-answer-content">
                        Peserta dapat memilih program yang tersedia,
                        kemudian melakukan pendaftaran melalui formulir
                        pendaftaran yang disediakan pada website.
                    </div>
                </div>

            </div>

            {{-- FAQ 4 --}}
            <div class="faq-item">

                <button
                    type="button"
                    class="faq-question"
                    aria-expanded="false"
                >
                    <span>
                        Apakah Akshara membuka peluang kolaborasi dengan
                        institusi atau komunitas?
                    </span>

                    <svg
                        class="faq-arrow"
                        viewBox="0 0 24 24"
                        fill="none"
                        aria-hidden="true"
                    >
                        <path
                            d="M6 9L12 15L18 9"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </svg>
                </button>

                <div class="faq-answer">
                    <div class="faq-answer-content">
                        Ya, Sekolah Riset Akshara terbuka untuk kolaborasi
                        dengan institusi pendidikan, komunitas, dan mitra
                        yang memiliki visi untuk mengembangkan pendidikan
                        dan riset.
                    </div>
                </div>

            </div>

        </div>

    </div>

</section>
    
{{-- =========================================
     JAVASCRIPT FAQ ACCORDION
     ========================================= --}}

<script>
    document.addEventListener('DOMContentLoaded', function () {

        // Mengambil semua item FAQ
        const faqItems = document.querySelectorAll('.faq-item');

        faqItems.forEach(function (item) {

            // Mengambil tombol pertanyaan
            const question = item.querySelector('.faq-question');

            // Ketika pertanyaan diklik
            question.addEventListener('click', function () {

                // Mengecek apakah FAQ sedang terbuka
                const isActive = item.classList.contains('active');

                // Menutup semua FAQ terlebih dahulu
                faqItems.forEach(function (faq) {

                    faq.classList.remove('active');

                    faq.querySelector('.faq-question')
                        .setAttribute('aria-expanded', 'false');

                });

                // Membuka FAQ yang diklik jika sebelumnya tertutup
                if (!isActive) {

                    item.classList.add('active');

                    question.setAttribute('aria-expanded', 'true');

                }

            });

        });

    });
</script>

    
{{-- =========================================
     SECTION KONTAK
     ========================================= --}}

<section id="kontak" class="contact-section">

    <div class="contact-container">

        {{-- Header Kontak --}}
        <div class="contact-header">

            <h2 class="contact-title">
                Mari terhubung.
            </h2>

            <p class="contact-description">
                Punya ide, kebutuhan, atau peluang kolaborasi? Mari berdiskusi dan wujudkan
                <br class="contact-desktop-break">
                gagasan menjadi sesuatu yang bermakna bersama Akshara.
            </p>

        </div>

        {{-- Kartu Informasi Kontak --}}
        <div class="contact-card-grid">

            {{-- WhatsApp --}}
            <a
                href="https://wa.me/6281384848055"
                target="_blank"
                rel="noopener noreferrer"
                class="contact-card"
            >

                <div class="contact-icon">

                    <svg viewBox="0 0 24 24" fill="none"
                         xmlns="http://www.w3.org/2000/svg">

                        <path
                            d="M20 11.5C20 16.2 16.2 20 11.5 20C9.8 20 8.2 19.5 6.9 18.6L3 20L4.4 16.3C3.5 14.9 3 13.2 3 11.5C3 6.8 6.8 3 11.5 3C16.2 3 20 6.8 20 11.5Z"
                            stroke="white"
                            stroke-width="1.7"
                            stroke-linejoin="round"
                        />

                        <path
                            d="M8 8.5C8.5 11 10.5 13 13 14L14.5 12.5L16.5 13.5V15.5C16.5 16 16 16.5 15.5 16.5C11 16.5 7 12.5 7 8C7 7.5 7.5 7 8 7H9.5L10.5 9L9 10.5"
                            stroke="white"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />

                    </svg>

                </div>

                <h3>Whatsapp</h3>

                <p>0813-8484-8055</p>

            </a>


            {{-- Email --}}
            <a
                href="mailto:akshara.edukreasi@gmail.com"
                class="contact-card"
            >

                <div class="contact-icon">

                    <svg viewBox="0 0 24 24" fill="none"
                         xmlns="http://www.w3.org/2000/svg">

                        <rect
                            x="3"
                            y="5"
                            width="18"
                            height="14"
                            rx="2"
                            stroke="white"
                            stroke-width="1.7"
                        />

                        <path
                            d="M4 7L12 13L20 7"
                            stroke="white"
                            stroke-width="1.7"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />

                    </svg>

                </div>

                <h3>Email</h3>

                <p>akshara.edukreasi@gmail.com</p>

            </a>


            {{-- Alamat --}}
            <div class="contact-card">

                <div class="contact-icon">

                    <svg viewBox="0 0 24 24" fill="none"
                         xmlns="http://www.w3.org/2000/svg">

                        <path
                            d="M20 10C20 15 12 22 12 22C12 22 4 15 4 10C4 5.6 7.6 2 12 2C16.4 2 20 5.6 20 10Z"
                            stroke="white"
                            stroke-width="1.7"
                            stroke-linejoin="round"
                        />

                        <circle
                            cx="12"
                            cy="10"
                            r="3"
                            stroke="white"
                            stroke-width="1.7"
                        />

                    </svg>

                </div>

                <h3>Alamat</h3>

                <p>Kota Malang</p>

            </div>

        </div>

    </div>


    {{-- =========================================
         FOOTER
         ========================================= --}}

    <footer class="contact-footer">

        <div class="contact-footer-container">

            {{-- Copyright --}}
            <div class="footer-copyright">
                © 2026 Akshara Edukreasi Indonesia
            </div>

            {{-- Navigasi Footer --}}
            <nav class="footer-navigation">

                <a href="#beranda">Beranda</a>

                <a href="#tentang">Tentang</a>

                <a href="#program">Program</a>

                <a href="#galeri">Galeri</a>

                <a href="#acara">Acara</a>

            </nav>

            {{-- Media Sosial --}}
            <div class="footer-social">

                {{-- Email --}}
                <a
                    href="mailto:akshara.edukreasi@gmail.com"
                    aria-label="Email Akshara"
                >

                    <svg viewBox="0 0 24 24" fill="none"
                         xmlns="http://www.w3.org/2000/svg">

                        <circle
                            cx="12"
                            cy="12"
                            r="10"
                            stroke="currentColor"
                            stroke-width="1.3"
                        />

                        <rect
                            x="6"
                            y="8"
                            width="12"
                            height="8"
                            rx="1"
                            stroke="currentColor"
                            stroke-width="1.2"
                        />

                        <path
                            d="M6 9L12 13L18 9"
                            stroke="currentColor"
                            stroke-width="1.2"
                        />

                    </svg>

                </a>


                {{-- Instagram --}}
                <a
                    href="https://www.instagram.com/"
                    target="_blank"
                    rel="noopener noreferrer"
                    aria-label="Instagram Akshara"
                >

                    <svg viewBox="0 0 24 24" fill="none"
                         xmlns="http://www.w3.org/2000/svg">

                        <rect
                            x="3"
                            y="3"
                            width="18"
                            height="18"
                            rx="5"
                            stroke="currentColor"
                            stroke-width="1.4"
                        />

                        <circle
                            cx="12"
                            cy="12"
                            r="4"
                            stroke="currentColor"
                            stroke-width="1.4"
                        />

                        <circle
                            cx="17.5"
                            cy="6.5"
                            r="1"
                            fill="currentColor"
                        />

                    </svg>

                </a>


                {{-- TikTok --}}
                <a
                    href="https://www.tiktok.com/"
                    target="_blank"
                    rel="noopener noreferrer"
                    aria-label="TikTok Akshara"
                >

                    <svg viewBox="0 0 24 24" fill="none"
                         xmlns="http://www.w3.org/2000/svg">

                        <circle
                            cx="12"
                            cy="12"
                            r="10"
                            stroke="currentColor"
                            stroke-width="1.3"
                        />

                        <path
                            d="M13 5V15.5C13 17 11.8 18 10.5 18C9.2 18 8 17 8 15.5C8 14 9.2 13 10.5 13C11.4 13 12.2 13.4 13 14"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />

                        <path
                            d="M13 5C13.5 7 15 8.5 17 9"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                        />

                    </svg>

                </a>

            </div>

        </div>

    </footer>

</section>



@endsection
