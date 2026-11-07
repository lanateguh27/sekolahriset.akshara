
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Sekolah Riset Akshara')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js',])
</head>

<body>

    {{-- Navbar --}}
    @include('components.navbar')

    {{-- Konten halaman --}}
    <main>
        @yield('content')
    </main>

</body>

</html>
