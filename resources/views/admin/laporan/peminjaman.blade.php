@extends('layouts.app')

@section('title', 'Laporan Peminjaman')

@section('styles')
<style>
    /* Styling untuk header laporan */
    .laporan-header {
        margin-bottom: 1.5rem;
        background: #fff;
        border-radius: 10px;
        padding: 1.5rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        border-left: 4px solid #7d5fff;
    }
    
    .laporan-header h2 {
        font-weight: 700;
        color: #333;
        margin-bottom: 0.5rem;
    }
    
    .laporan-header p {
        color: #6c757d;
        margin-bottom: 0;
    }
    
    /* Styling untuk form filter yang lebih compact */
    .filter-form {
        background: #fff;
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 1rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }
    
    .filter-form .form-group {
        margin-bottom: 0.5rem;
    }
    
    .filter-form .form-label {
        font-size: 0.85rem;
        font-weight: 500;
        color: #495057;
        margin-bottom: 0.25rem;
        display: block;
    }
    
    .filter-form .form-control,
    .filter-form .form-select {
        height: 32px;
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
        border: 1px solid #ced4da;
        border-radius: 4px;
        width: 100%;
    }
    
    .filter-form .input-group {
        position: relative;
    }
    
    .filter-form .input-group .calendar-icon {
        position: absolute;
        right: 8px;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
        font-size: 0.8rem;
        z-index: 4;
        pointer-events: none;
    }
    
    /* Styling untuk tombol filter yang lebih compact */
    .filter-buttons {
        display: flex;
        gap: 6px;
        margin-top: 0.75rem;
    }
    
    .btn-filter, .btn-reset, .btn-export {
        font-size: 0.8rem;
        padding: 0.35rem 0.75rem;
        border-radius: 4px;
        font-weight: 500;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }
    
    .btn-filter {
        background-color: #7d5fff;
        color: white;
        border: none;
    }
    
    .btn-filter:hover {
        background-color: #6a4ddb;
    }
    
    .btn-reset {
        background-color: #6c757d;
        color: white;
        border: none;
    }
    
    .btn-reset:hover {
        background-color: #5a6268;
    }
    
    .btn-export {
        background-color: #28a745;
        color: white;
        border: none;
    }
    
    .btn-export:hover {
        background-color: #218838;
    }
    
    .btn-icon {
        margin-right: 4px;
        font-size: 0.8rem;
    }
    
    /* Styling untuk tabel */
    .table-container {
        background: #fff;
        border-radius: 10px;
        padding: 1.5rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        overflow-x: auto;
    }
    
    .table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 0;
    }
    
    .table th {
        background-color: #f8f9fa;
        color: #495057;
        font-weight: 600;
        text-align: left;
        padding: 1rem;
        border-bottom: 2px solid #dee2e6;
        white-space: nowrap;
    }
    
    .table td {
        padding: 1rem;
        border-bottom: 1px solid #dee2e6;
        vertical-align: middle;
    }
    
    .table tr:hover {
        background-color: #f8f9fa;
    }
    
    .table tr:last-child td {
        border-bottom: none;
    }
    
    /* Styling untuk badge status */
    .badge {
        padding: 0.5rem 0.75rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 500;
        text-transform: capitalize;
    }
    
    .badge-menunggu {
        background-color: #fff3cd;
        color: #856404;
    }
    
    .badge-disetujui {
        background-color: #d4edda;
        color: #155724;
    }
    
    .badge-ditolak {
        background-color: #f8d7da;
        color: #721c24;
    }
    
    .badge-dikembalikan {
        background-color: #d1ecf1;
        color: #0c5460;
    }
    
    /* Styling untuk empty state */
    .empty-state {
        text-align: center;
        padding: 3rem 1.5rem;
    }
    
    .empty-state i {
        font-size: 3rem;
        color: #dee2e6;
        margin-bottom: 1rem;
    }
    
    .empty-state h5 {
        font-weight: 600;
        color: #343a40;
        margin-bottom: 0.5rem;
    }
    
    .empty-state p {
        color: #6c757d;
        max-width: 400px;
        margin: 0 auto;
    }
    
    /* Responsivitas */
    @media (max-width: 768px) {
        .filter-buttons {
            flex-direction: column;
        }
        
        .filter-form .row {
            margin-bottom: 0;
        }
        
        .filter-form .col-md-4 {
            margin-bottom: 1rem;
        }
    }
</style>
@endsection

@section('content')
<div class="container py-4">
    <div class="laporan-header">
        <h2>Laporan Peminjaman Barang</h2>
        <p class="text-muted">Laporan data peminjaman barang</p>
    </div>
    
    <div class="filter-form">
        <form action="{{ route('laporan.peminjaman') }}" method="GET">
            <div class="row g-2">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                        <div class="input-group">
                            <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" value="{{ request('tanggal_mulai') }}">
                            <span class="calendar-icon">
                                <i class="bi bi-calendar3"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
                        <div class="input-group">
                            <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}">
                            <span class="calendar-icon">
                                <i class="bi bi-calendar3"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="">Semua Status</option>
                            <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                            <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                            <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                            <option value="dikembalikan" {{ request('status') == 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group" style="margin-top: 1.5rem;">
                        <div class="filter-buttons">
                            </button>
                            <a href="{{ route('laporan.peminjaman') }}" class="btn-reset">
                                <i class="bi bi-arrow-counterclockwise btn-icon"></i> Reset
                            </a>
                            <button type="submit" name="export" value="excel" class="btn-export">
                                <i class="bi bi-file-earmark-excel-fill btn-icon"></i> Export
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Peminjam</th>
                    <th>Barang</th>
                    <th>Jumlah</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($peminjamans as $index => $peminjaman)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $peminjaman->user->name ?? 'User tidak ditemukan' }}</td>
                    <td>{{ $peminjaman->barang->nama ?? $peminjaman->barang->nama_barang ?? 'Barang tidak ditemukan' }}</td>
                    <td>{{ $peminjaman->jumlah }}</td>
                    <td>{{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d M Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($peminjaman->tanggal_kembali)->format('d M Y') }}</td>
                    <td>
                        <span class="badge badge-{{ $peminjaman->status }}">
                            {{ ucfirst($peminjaman->status) }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7">
                        <div class="empty-state">
                            <i class="bi bi-inbox"></i>
                            <h5>Tidak ada data peminjaman</h5>
                            <p class="text-muted">Data peminjaman akan muncul di sini setelah ada peminjaman barang.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Tambahkan script jika diperlukan
</script>
@endsection









