@extends('layouts.app')

@section('title', 'Detail Pengembalian')

@section('styles')
<style>
    body {
        background-color: #f8f9fa;
    }
    
    .page-header {
        margin-bottom: 1.5rem;
        background: #fff;
        border-radius: 10px;
        padding: 1.5rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        border-left: 4px solid #7d5fff;
    }
    
    .page-header h2 {
        font-weight: 700;
        color: #333;
        margin-bottom: 0.5rem;
    }
    
    .page-header p {
        color: #6c757d;
        margin-bottom: 0;
    }
    
    .detail-container {
        background: #fff;
        border-radius: 10px;
        padding: 2rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        margin-bottom: 1.5rem;
    }
    
    .detail-row {
        display: flex;
        margin-bottom: 1rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #f1f3f4;
    }
    
    .detail-row:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }
    
    .detail-label {
        font-weight: 600;
        color: #495057;
        width: 200px;
        flex-shrink: 0;
    }
    
    .detail-value {
        color: #212529;
        flex: 1;
    }
    
    .badge {
        padding: 0.4rem 0.8rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 500;
        text-transform: capitalize;
        display: inline-block;
    }
    
    .badge-menunggu {
        background-color: #fff3cd;
        color: #856404;
    }
    
    .badge-diterima {
        background-color: #d4edda;
        color: #155724;
    }
    
    .badge-ditolak {
        background-color: #f8d7da;
        color: #721c24;
    }
    
    .badge-baik {
        background-color: #d4edda;
        color: #155724;
    }
    
    .badge-rusak {
        background-color: #fff3cd;
        color: #856404;
    }
    
    .badge-hilang {
        background-color: #f8d7da;
        color: #721c24;
    }
    
    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        border: none;
        font-size: 0.9rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        margin-right: 0.5rem;
    }
    
    .btn-primary {
        background-color: #4f46e5;
        color: white;
    }
    
    .btn-primary:hover {
        background-color: #4338ca;
        color: white;
        text-decoration: none;
    }
    
    .btn-secondary {
        background-color: #6c757d;
        color: white;
    }
    
    .btn-secondary:hover {
        background-color: #5a6268;
        color: white;
        text-decoration: none;
    }
    
    .btn-success {
        background-color: #28a745;
        color: white;
    }
    
    .btn-success:hover {
        background-color: #218838;
        color: white;
    }
    
    .btn i {
        margin-right: 0.5rem;
        font-size: 0.8rem;
    }
    
    .denda-section {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 1.5rem;
        margin-top: 1rem;
        border-left: 4px solid #ffc107;
    }
    
    .denda-title {
        font-weight: 600;
        color: #495057;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
    }
    
    .denda-title i {
        margin-right: 0.5rem;
        color: #ffc107;
    }
    
    .form-group {
        margin-bottom: 1rem;
    }
    
    .form-label {
        font-weight: 500;
        color: #495057;
        margin-bottom: 0.5rem;
        display: block;
    }
    
    .form-control {
        width: 100%;
        padding: 0.5rem 0.75rem;
        border: 1px solid #ced4da;
        border-radius: 6px;
        font-size: 0.9rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
    
    .form-control:focus {
        border-color: #7d5fff;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(125, 95, 255, 0.25);
    }
    
    .current-denda {
        font-size: 1.1rem;
        font-weight: 600;
        color: #dc3545;
    }
    
    .alert {
        padding: 0.75rem 1rem;
        margin-bottom: 1rem;
        border: 1px solid transparent;
        border-radius: 6px;
    }
    
    .alert-success {
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
    }
    
    .alert-danger {
        color: #721c24;
        background-color: #f8d7da;
        border-color: #f5c6cb;
    }
</style>
@endsection

@section('content')
<div class="container py-4">
    <div class="page-header">
        <h2>Detail Pengembalian Barang</h2>
        <p class="text-muted">Informasi lengkap pengembalian barang</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="detail-container">
        <h4 class="mb-3">Informasi Pengembalian</h4>
        
        <div class="detail-row">
            <div class="detail-label">ID Pengembalian:</div>
            <div class="detail-value">#{{ $pengembalian->id }}</div>
        </div>
        
        <div class="detail-row">
            <div class="detail-label">Nama Pengembali:</div>
            <div class="detail-value">{{ $pengembalian->peminjaman->user->name }}</div>
        </div>
        
        <div class="detail-row">
            <div class="detail-label">Nama Barang:</div>
            <div class="detail-value">{{ $pengembalian->peminjaman->barang->nama_barang }}</div>
        </div>
        
        <div class="detail-row">
            <div class="detail-label">Tanggal Peminjaman:</div>
            <div class="detail-value">{{ \Carbon\Carbon::parse($pengembalian->peminjaman->tanggal_pinjam)->format('d M Y') }}</div>
        </div>
        
        <div class="detail-row">
            <div class="detail-label">Tanggal Seharusnya Kembali:</div>
            <div class="detail-value">{{ \Carbon\Carbon::parse($pengembalian->peminjaman->tanggal_kembali)->format('d M Y') }}</div>
        </div>
        
        <div class="detail-row">
            <div class="detail-label">Tanggal Pengembalian:</div>
            <div class="detail-value">{{ \Carbon\Carbon::parse($pengembalian->tanggal_pengembalian)->format('d M Y') }}</div>
        </div>
        
        <div class="detail-row">
            <div class="detail-label">Jumlah Dipinjam:</div>
            <div class="detail-value">{{ $pengembalian->peminjaman->jumlah }}</div>
        </div>
        
        <div class="detail-row">
            <div class="detail-label">Jumlah Dikembalikan:</div>
            <div class="detail-value">{{ $pengembalian->jumlah_kembali }}</div>
        </div>
        
        <div class="detail-row">
            <div class="detail-label">Kondisi Barang:</div>
            <div class="detail-value">
                <span class="badge badge-{{ $pengembalian->kondisi_barang }}">
                    {{ ucfirst($pengembalian->kondisi_barang) }}
                </span>
            </div>
        </div>
        
        <div class="detail-row">
            <div class="detail-label">Status:</div>
            <div class="detail-value">
                <span class="badge badge-{{ $pengembalian->status }}">
                    {{ ucfirst($pengembalian->status) }}
                </span>
            </div>
        </div>
        
        @if($pengembalian->catatan)
        <div class="detail-row">
            <div class="detail-label">Catatan:</div>
            <div class="detail-value">{{ $pengembalian->catatan }}</div>
        </div>
        @endif

        <!-- Section Denda -->
        <div class="denda-section">
            <div class="denda-title">
                <i class="bi bi-exclamation-triangle"></i>
                Informasi Denda
            </div>
            
            <div class="detail-row">
                <div class="detail-label">Biaya Denda Saat Ini:</div>
                <div class="detail-value current-denda">
                    Rp {{ number_format($pengembalian->biaya_denda, 0, ',', '.') }}
                </div>
            </div>

            <!-- Form untuk mengubah denda -->
            <form action="{{ route('admin.pengembalian.update-denda', $pengembalian->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="biaya_denda" class="form-label">Ubah Biaya Denda:</label>
                    <input type="number" 
                           class="form-control" 
                           id="biaya_denda" 
                           name="biaya_denda" 
                           value="{{ $pengembalian->biaya_denda }}" 
                           min="0" 
                           step="1000"
                           placeholder="Masukkan jumlah denda">
                </div>
                
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-circle"></i>
                    Update Denda
                </button>
            </form>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('pengembalian.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i>
            Kembali ke Daftar
        </a>
        
        @if($pengembalian->status == 'menunggu')
            <form action="{{ route('pengembalian.approve', $pengembalian->id) }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-success" onclick="return confirm('Apakah Anda yakin ingin menyetujui pengembalian ini?')">
                    <i class="bi bi-check-circle"></i>
                    Setujui Pengembalian
                </button>
            </form>
            
            <form action="{{ route('pengembalian.reject', $pengembalian->id) }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menolak pengembalian ini?')">
                    <i class="bi bi-x-circle"></i>
                    Tolak Pengembalian
                </button>
            </form>
        @endif
    </div>
</div>
@endsection
