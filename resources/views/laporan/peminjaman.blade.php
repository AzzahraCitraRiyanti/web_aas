@extends('layouts.app')

@section('title', 'Laporan Peminjaman')

@section('styles')
<style>
    .page-header {
        background-color: var(--bs-white);
        border-radius: var(--bs-border-radius-lg);
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: var(--bs-box-shadow-sm);
        border-left: 4px solid var(--bs-primary);
    }
    
    .card {
        border: none;
        box-shadow: var(--bs-box-shadow-sm);
        border-radius: var(--bs-border-radius);
        transition: transform 0.2s;
    }
    
    .badge {
        font-weight: 500;
        padding: 0.5em 0.8em;
    }
    
    .badge-menunggu {
        background-color: #fff3cd;
        color: #856404;
    }
    
    .badge-disetujui {
        background-color: #d1e7dd;
        color: #0f5132;
    }
    
    .badge-ditolak {
        background-color: #f8d7da;
        color: #842029;
    }
    
    .badge-dikembalikan {
        background-color: #cfe2ff;
        color: #084298;
    }
    
    .table-responsive {
        border-radius: var(--bs-border-radius);
    }
    
    .table {
        margin-bottom: 0;
    }
    
    .table th {
        background-color: var(--bs-tertiary-bg);
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
    }
    
    .empty-state {
        padding: 3rem;
        text-align: center;
        color: var(--bs-secondary-color);
    }
</style>
@endsection

@section('content')
<div class="container py-4">
    <div class="page-header">
        <h2 class="mb-1">Laporan Peminjaman Barang</h2>
        <p class="text-muted mb-0">Laporan data peminjaman barang</p>
    </div>
    
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('laporan.peminjaman') }}" method="GET">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" value="{{ request('tanggal_mulai') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
                        <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="">Semua Status</option>
                            <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                            <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                            <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                            <option value="dikembalikan" {{ request('status') == 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                        </select>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-filter"></i> Filter
                            </button>
                            <a href="{{ route('laporan.peminjaman') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-counterclockwise"></i> Reset
                            </a>
                            <button type="submit" name="export" value="excel" class="btn btn-success">
                                <i class="bi bi-file-earmark-excel"></i> Export
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th class="ps-3">No</th>
                            <th>Nama Peminjam</th>
                            <th>Barang</th>
                            <th>Jumlah</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th class="pe-3">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($peminjamans as $index => $peminjaman)
                        <tr>
                            <td class="ps-3">{{ $index + 1 }}</td>
                            <td>{{ $peminjaman->user->name ?? 'User tidak ditemukan' }}</td>
                            <td>{{ $peminjaman->barang->nama_barang ?? 'Barang tidak ditemukan' }}</td>
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
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Script jika diperlukan
</script>
@endsection