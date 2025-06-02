<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Aplikasi Peminjaman Barang</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background-color: #fdf6ee;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .login-card {
            background: #fffefb;
            padding: 2.5rem 2rem;
            border-radius: 1.25rem;
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 420px;
        }

        .login-card h4 {
            font-weight: 700;
            color: #8b5e3c;
            margin-bottom: 1.5rem;
        }

        .form-control {
            border-radius: 0.75rem;
            padding: 0.75rem;
            border: 1px solid #ddd;
            background-color: #fefaf6;
        }

        .btn-custom {
            background-color: #d9a97c;
            border: none;
            color: white;
            border-radius: 0.75rem;
            padding: 0.75rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #c28960;
        }

        .footer-note {
            font-size: 0.85rem;
            color: #998675;
            margin-top: 2rem;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="container" style="max-width: 440px;">
        <div class="login-card">
            <div class="text-center mb-4">
                <h4>Aplikasi Peminjaman Barang</h4>
            </div>

            <form method="POST" action="{{ route('auth.login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}"
                        required autofocus placeholder="admin@email.com">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required
                        placeholder="********">
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-custom">Login</button>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger mt-3">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </form>

            <div class="footer-note mt-4">
                © 2025 Aplikasi Sarpras. Hanya untuk Admin.
            </div>
        </div>
    </div>

    {{-- ALERT LOGIN BERHASIL --}}
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session("success") }}',
                showConfirmButton: false,
                timer: 2000
            });

            setTimeout(function () {
                window.location.href = "{{ route('admin.dashboard') }}";
            }, 2000);
        </script>
    @endif

</body>

</html>
