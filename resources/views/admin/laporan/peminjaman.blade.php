@extends('layouts.app')

@section('title', 'Laporan Peminjaman')

@section('styles')
<style>
    .laporan-header {
        margin-bottom: 1.5rem;
    }
    
    .filter-form {
        background: #fff;
        border-radius: 10px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }
    
    .filter-form .row {
        align-items: flex-end;
    }
    
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
    }
    
    .table th {
        background-color: #f8f9fa;
        color: #495057;
        font-weight: 600;
        text-align: left;
        padding: 12px 15px;
        border-bottom: 2px solid #dee2e6;
    }
    
    .table td {
        padding: 12px 15px;
        border-bottom: 1px solid #dee2e6;
        vertical-align: middle;
    }
    
    .table tr:hover {
        background-color: #f8f9fa;
    }
    
    .badge {
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }
    
    .badge-menunggu {
        background-color: #ffeeba;
        color: #856404;
    }
    
    .badge-disetujui {
        background-color: #c3e6cb;
        color: #155724;
    }
    
    .badge-ditolak {
        background-color: #f5c6cb;
        color: #721c24;
    }
    
    .badge-dikembalikan {
        background-color: #b8daff;
        color: #004085;
    }
    
    .btn-export {
        background-color: #28a745;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 4px;
        cursor: pointer;
        font-weight: 500;
    }
    
    .btn-export:hover {
        background-color: #218838;
    }
    
    .btn-filter {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 4px;
        cursor: pointer;
        font-weight: 500;
    }
    
    .btn-filter:hover {
        background-color: #0069d9;
    }
    
    .btn-reset {
        background-color: #6c757d;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 4px;
        cursor: pointer;
        font-weight: 500;
    }
    
    .btn-reset:hover {
        background-color: #5a6268;
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
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                    <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" value="{{ request('tanggal_mulai') }}">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
                    <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status">
                        <option value="">Semua Status</option>
                        <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                        <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        <option value="dikembalikan" {{ request('status') == 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3 d-flex">
                    <button type="submit" class="btn-filter me-2">Filter</button>
                    <a href="{{ route('laporan.peminjaman') }}" class="btn-reset me-2">Reset</a>
                    <button type="submit" name="export" value="excel" class="btn-export">Export Excel</button>
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
                    <td class="ps-3">{{ $index + 1 }}</td>
                    <td>{{ $peminjaman->user->name ?? 'User tidak ditemukan' }}</td>
                    <td>{{ $peminjaman->barang->nama ?? $peminjaman->barang->nama_barang ?? 'Barang tidak ditemukan' }}</td>
                    <td>{{ $peminjaman->jumlah }}</td>
                    <td>{{ $peminjaman->tanggal_pinjam }}</td>
                    <td>{{ $peminjaman->tanggal_kembali }}</td>
                    <td class="pe-3">
                        <span class="badge badge-{{ $peminjaman->status }}">
                            {{ ucfirst($peminjaman->status) }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7">
                        <div class="empty-state">
                            <i class="bi bi-inbox fs-1 d-block mb-3"></i>
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


