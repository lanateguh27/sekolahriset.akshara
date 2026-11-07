<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login Admin | Sekolah Riset Akshara</title>

    {{-- Memuat font Montserrat --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            background: #f5f4f8;
            font-family: 'Montserrat', sans-serif;
        }

        .login-container {
            width: 100%;
            max-width: 430px;
            padding: 40px;
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 12px 40px rgba(40, 25, 65, 0.08);
        }

        .login-header {
            margin-bottom: 30px;
            text-align: center;
        }

        .login-header h1 {
            margin-bottom: 10px;
            color: #302344;
            font-size: 24px;
            font-weight: 700;
        }

        .login-header p {
            color: #777184;
            font-size: 13px;
            line-height: 1.7;
        }

        .login-field {
            margin-bottom: 20px;
        }

        .login-field label {
            display: block;
            margin-bottom: 9px;
            color: #393044;
            font-size: 13px;
            font-weight: 600;
        }

        .login-field input {
            width: 100%;
            padding: 13px 15px;
            border: 1px solid #e2deea;
            border-radius: 10px;
            outline: none;
            font-family: inherit;
            font-size: 13px;
            transition: border-color 0.2s;
        }

        .login-field input:focus {
            border-color: #8b5cf6;
        }

        .login-error {
            margin-bottom: 18px;
            padding: 12px 14px;
            border-radius: 9px;
            background: #fff0f0;
            color: #c62828;
            font-size: 12px;
            line-height: 1.6;
        }

        .login-button {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 10px;
            background: #7652b5;
            color: #ffffff;
            font-family: inherit;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

        .login-button:hover {
            background: #62409e;
        }

        .login-footer {
            margin-top: 24px;
            text-align: center;
            color: #96909f;
            font-size: 11px;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 30px 24px;
            }
        }
    </style>
</head>

<body>
    <main class="login-container">
        <div class="login-header">
            <h1>Admin Login</h1>
            <p>
                Sekolah Riset Akshara<br>
                Silakan masuk untuk mengelola website.
            </p>
        </div>

        {{-- Menampilkan pesan error jika login gagal --}}
        @if ($errors->any())
            <div class="login-error">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST">
            @csrf

            <div class="login-field">
                <label for="email">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Masukkan email admin"
                    autocomplete="username"
                    required
                    autofocus
                >
            </div>

            <div class="login-field">
                <label for="password">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Masukkan password"
                    autocomplete="current-password"
                    required
                >
            </div>

            <button type="submit" class="login-button">
                Masuk ke Dashboard
            </button>
        </form>

        <div class="login-footer">
            &copy; {{ date('Y') }} Sekolah Riset Akshara
        </div>
    </main>
</body>
</html>