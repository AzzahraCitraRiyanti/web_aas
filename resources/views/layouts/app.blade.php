<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard')</title>

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- Tambahan CSS dari halaman --}}
    @yield('styles')

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
        }

        body {
            display: flex;
            min-height: 100vh;
            background-color: #f4f6f8;
        }

        /* SIDEBAR */
        .sidebar {
            width: 260px;
            background: linear-gradient(135deg, #ab9b81 80%, #66543f 100%);
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: stretch;
            padding: 30px 0 20px 0;
            box-shadow: 2px 0 20px rgba(44, 62, 80, 0.05);
            position: relative;
            z-index: 2;
        }

        .sidebar .brand {
            font-size: 2rem;
            font-weight: bold;
            letter-spacing: 3px;
            text-align: center;
            margin-bottom: 36px;
            color: #fff;
        }

        .sidebar-nav {
            flex: 1;
        }

        .sidebar-section {
            margin-bottom: 22px;
        }

        .sidebar-section .section-title {
            font-size: 12px;
            color: #c8f7c5;
            margin: 0 0 10px 28px;
            letter-spacing: 1.5px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 10px 28px;
            color: #fff;
            text-decoration: none;
            font-size: 16px;
            border-left: 4px solid transparent;
            transition: all 0.18s;
            border-radius: 0 20px 20px 0;
            margin-bottom: 2px;
        }

        .sidebar-link i {
            font-size: 1.2em;
            width: 22px;
            text-align: center;
        }

        .sidebar-link.active,
        .sidebar-link:hover {
            background: rgba(255, 255, 255, 0.09);
            border-left: 4px solid #fff;
            color: #fff;
            font-weight: 600;
        }

        .logout-section {
            margin-top: auto;
            padding: 0 28px;
        }

        .logout-btn {
            width: 100%;
            background: #fff;
            color: #a67c52;
            border: none;
            border-radius: 8px;
            padding: 10px 0;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 14px;
            transition: background 0.15s, color 0.15s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .logout-btn:hover {
            background: #a67c52;
            color: #fff;
            border: 1px solid #fff;
        }

        /* CONTENT */
        .content {
            flex: 1;
            padding: 32px;
            background-color: #f9fbfc;
        }

        /* RESPONSIVE SIDEBAR */
        @media (max-width: 900px) {
            .sidebar {
                width: 70px;
                padding: 20px 0;
            }

            .sidebar .brand,
            .sidebar-section .section-title,
            .logout-btn span {
                display: none;
            }

            .sidebar-link {
                justify-content: center;
                padding: 10px 0;
            }

            .sidebar-link span {
                display: none;
            }

            .logout-btn {
                padding: 10px;
            }
        }
    </style>
</head>

<body>
    <nav class="sidebar">
        <div class="brand">
            <i class="bi bi-box-seam"></i> SARFO
        </div>

        <div class="sidebar-nav">
            <div class="sidebar-section">
                <div class="section-title">ADMINISTRATOR</div>
                <a href="{{ route('admin.dashboard') }}"
                    class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-house-door"></i>
                    <span>Dashboard</span>
                </a>
            </div>

            <div class="sidebar-section">
                <div class="section-title">DATA UTAMA</div>
                <a href="{{ route('kategori.index') }}"
                    class="sidebar-link {{ request()->routeIs('kategori.*') ? 'active' : '' }}">
                    <i class="bi bi-tags"></i>
                    <span>Kategori Barang</span>
                </a>
                <a href="{{ route('barang.index') }}"
                    class="sidebar-link {{ request()->routeIs('barang.*') ? 'active' : '' }}">
                    <i class="bi bi-box"></i>
                    <span>Data Barang</span>
                </a>
                <a href="{{ route('admin.user.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.user.*') ? 'active' : '' }}">
                    <i class="bi bi-person-badge"></i>
                    <span>Manajemen User</span>
                </a>
            </div>

            <div class="sidebar-section">
                <div class="section-title">TRANSAKSI</div>
                <a href="{{ route('admin.peminjaman.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.peminjaman.index') ? 'active' : '' }}">
                    <i class="bi bi-arrow-left-right"></i>
                    <span>Peminjaman Barang</span>
                </a>
                <a href="{{ route('pengembalian.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.pengembalian.*') ? 'active' : '' }}">
                    <i class="bi bi-arrow-repeat"></i>
                    <span>Pengembalian Barang</span>
                </a>
            </div>

            <div class="sidebar-section">
                <div class="section-title">LAPORAN</div>
                <a href="{{ route('laporan.peminjaman') }}"
                    class="sidebar-link {{ request()->routeIs('laporan.peminjaman') ? 'active' : '' }}">
                    <i class="bi bi-file-text"></i>
                    <span>Laporan Peminjaman</span>
                </a>
                <a href="{{ route('laporan.pengembalian') }}"
                    class="sidebar-link {{ request()->routeIs('laporan.pengembalian') ? 'active' : '' }}">
                    <i class="bi bi-file-earmark-text"></i>
                    <span>Laporan Pengembalian</span>
                </a>
            </div>
        </div>

        <div class="logout-section">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </nav>

    <div class="content">
        @yield('content')
    </div>

    {{-- Tambahan JS dari halaman --}}
    @yield('scripts')
</body>

</html>
