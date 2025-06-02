<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome | Admin Sarpras</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        figtree: ['Figtree', 'sans-serif']
                    },
                    colors: {
                        cream: '#fdf6ee',
                        lightCream: '#fffaf3',
                        brown: '#8b5e3c',
                        softBrown: '#b97a57'
                    }
                }
            }
        }
    </script>
</head>

<body class="min-h-screen bg-cream flex items-center justify-center font-figtree">
    <div class="bg-lightCream rounded-2xl shadow-2xl p-10 max-w-xl w-full text-center border border-orange-100">
        <div class="flex justify-center mb-6">
            <!-- Icon Sarpras/Asset -->
            <svg width="64" height="64" fill="none" viewBox="0 0 62 65" xmlns="http://www.w3.org/2000/svg"
                class="h-16 w-16">
                <rect width="62" height="65" rx="12" fill="#b97a57" fill-opacity="0.1" />
                <path d="M16 44V24L31 14L46 24V44C46 45.1046 45.1046 46 44 46H18C16.8954 46 16 45.1046 16 44Z"
                    fill="#b97a57" />
                <rect x="24" y="34" width="14" height="12" rx="2" fill="#ddb892" />
            </svg>
        </div>

        <h1 class="text-3xl font-bold text-brown mb-2">Aplikasi Sarpras Admin</h1>
        <p class="text-gray-700 mb-6 leading-relaxed">
            Selamat datang di sistem manajemen sarana & prasarana.<br>
            <span class="text-red-500 font-semibold">Hanya admin yang dapat mengakses aplikasi ini.</span>
        </p>

        <a href="/login"
            class="inline-block px-8 py-3 bg-softBrown text-white rounded-full font-semibold shadow-md hover:bg-brown transition">
            Login Admin
        </a>

        <div class="mt-8 text-xs text-gray-500">
            © 2025 Aplikasi Sarpras. Hak cipta dilindungi.
        </div>
    </div>
</body>

</html>
