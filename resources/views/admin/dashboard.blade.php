@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('styles')
<style>
    .dashboard-header {
        font-weight: 700;
        margin-bottom: 2rem;
        color: #34495e;
        position: relative;
        padding-bottom: 0.5rem;
    }
    
    .dashboard-header:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 3px;
        background: #ab9b81;
        border-radius: 3px;
    }

    .dashboard-cards {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .dashboard-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        padding: 1.5rem;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        text-decoration: none;
    }

    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
    }

    .dashboard-card .icon-bg {
        position: absolute;
        top: -15px;
        right: -15px;
        font-size: 5rem;
        opacity: 0.1;
        color: #000;
        z-index: 0;
    }

    .dashboard-card h3 {
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 0.75rem;
        color: #555;
        z-index: 1;
        position: relative;
    }

    .dashboard-card .count {
        font-size: 2.5rem;
        font-weight: 700;
        color: #333;
        z-index: 1;
        position: relative;
        margin-top: auto;
    }

    .dashboard-card.barang {
        border-top: 4px solid #3498db;
    }

    .dashboard-card.kategori {
        border-top: 4px solid #2ecc71;
    }

    .dashboard-card.users {
        border-top: 4px solid #9b59b6;
    }

    .dashboard-card.ruangan {
        border-top: 4px solid #e74c3c;
    }
    
    .alert {
        margin-bottom: 1.5rem;
        border-radius: 8px;
    }
    
    .stats-section {
        margin-top: 2rem;
    }
    
    .stats-section h3 {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 1rem;
        color: #555;
        position: relative;
        padding-bottom: 0.5rem;
    }
    
    .stats-section h3:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 40px;
        height: 2px;
        background: #ab9b81;
        border-radius: 3px;
    }
    
    .stats-container {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        padding: 1.5rem;
    }
    
    .activity-empty {
        padding: 2rem;
        text-align: center;
        color: #888;
        font-style: italic;
        background: #f9f9f9;
        border-radius: 8px;
        border: 1px dashed #ddd;
    }
    
    /* Styling untuk footer */
    .dashboard-footer {
        text-align: center;
        margin-top: 3rem;
        padding: 1.5rem 0;
        color: #888;
        font-size: 0.9rem;
        border-top: 1px solid #eee;
    }
    
    .dashboard-footer span {
        display: inline-block;
        padding: 0.5rem 1rem;
        background: #f8f5f0;
        border-radius: 20px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    }
    
    /* Tambahan styling baru */
    .container {
        max-width: 1200px;
        margin: 0 auto;
    }
    
    .dashboard-summary {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        padding: 1.5rem;
        margin-bottom: 2rem;
    }
    
    .dashboard-summary p {
        color: #666;
        line-height: 1.6;
    }
    
    .dashboard-cards .dashboard-card .badge {
        position: absolute;
        top: 10px;
        right: 10px;
        padding: 0.25rem 0.5rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        background: #f8f9fa;
        color: #6c757d;
    }
    
    @media (max-width: 768px) {
        .dashboard-cards {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
    <div class="container py-4">
        <h2 class="dashboard-header">Dashboard Admin</h2>
        
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <div class="dashboard-summary">
            <p>Selamat datang di Dashboard Admin. Berikut adalah ringkasan data sistem Anda.</p>
        </div>
        
        <div class="dashboard-cards">
            <!-- Data Barang -->
            <a href="{{ route('barang.index') }}" class="dashboard-card barang">
                <span class="icon-bg"><i class="bi bi-box"></i></span>
                <span class="badge">Data</span>
                <h3>Data Barang</h3>
                <span class="count">{{ $databarang }}</span>
            </a>

            <!-- Kategori Barang -->
            <a href="{{ route('kategori.index') }}" class="dashboard-card kategori">
                <span class="icon-bg"><i class="bi bi-tags"></i></span>
                <span class="badge">Kategori</span>
                <h3>Kategori Barang</h3>
                <span class="count">{{ $datakategori }}</span>
            </a>

            <!-- Users -->
            <a href="{{ route('admin.user.index') }}" class="dashboard-card users">
                <span class="icon-bg"><i class="bi bi-people"></i></span>
                <span class="badge">Pengguna</span>
                <h3>Users</h3>
                <span class="count">{{ $datausers ?? 0 }}</span>
            </a>
            
            <!-- Ruangan -->
            <div class="dashboard-card ruangan">
                <span class="icon-bg"><i class="bi bi-building"></i></span>
                <span class="badge">Fasilitas</span>
                <h3>Ruangan</h3>
                <span class="count">{{ $dataruangan ?? 50 }}</span>
            </div>
        </div>
        
       
        <!-- Footer -->
        <div class="dashboard-footer">
            <span>&copy; 2025 Sistem Administrasi Sarana Prasarana</span>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    // Tambahkan script jika diperlukan
</script>
@endsection
