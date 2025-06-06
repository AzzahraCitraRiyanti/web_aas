@extends('layouts.app')

@section('title', 'Laporan Pengembalian')

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
    
    /* Styling untuk form filter yang compact */
    .filter-form {
        background: #fff;
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 1rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }
    
    .filter-form .row {
        align-items: flex-end;
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
    
    /* Styling untuk tombol filter yang compact */
    .filter-buttons {
        display: flex;
        gap: 6px;
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
        padding: 0.75rem 1rem;
        border-bottom: 2px solid #dee2e6;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .table td {
        padding: 0.75rem 1rem;
        border-bottom: 1px solid #dee2e6;
        vertical-align: middle;
        font-size: 0.9rem;
    }
    
    .table tr:hover {
        background-color: #f8f9fa;
    }
    
    .table tr:last-child td {
        border-bottom: none;
    }
    
    /* Styling untuk badge status */
    .badge {
        padding: 0.4rem 0.6rem;
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
    
    .badge-baik {
        background-color: #d4edda;
        color: #155724;
    }
    
    .badge-rusak {
        background-color: #f8d7da;
        color: #721c24;
    }
    
    .badge-hilang {
        background-color: #fff3cd;
        color: #856404;
    }
    
    /* Responsivitas */
    @media (max-width: 768px) {
        .filter-form .row {
            margin-bottom: 0;
        }
        
        .filter-form .col-md-3 {
            margin-bottom: 0.5rem;
        }
        
        .filter-buttons {
            flex-wrap: wrap;
        }
    }
</style>
@endsection

@section('content')
<div class="container py-4">
    <div class="laporan-header">
        <h2>Laporan Pengembalian Barang</h2>
        <p class="text-muted">Laporan data pengembalian barang</p>
    </div>
    
    <div class="filter-form">
        <form action="{{ route('laporan.pengembalian') }}" method="GET">
            <div class="row g-2">
                <div class="col-md-2">
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
                <div class="col-md-2">
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
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="kondisi" class="form-label">Kondisi</label>
                        <select class="form-select" id="kondisi" name="kondisi">
                            <option value="">Semua Kondisi</option>
                            <option value="baik" {{ request('kondisi') == 'baik' ? 'selected' : '' }}>Baik</option>
                            <option value="rusak" {{ request('kondisi') == 'rusak' ? 'selected' : '' }}>Rusak</option>
                            <option value="hilang" {{ request('kondisi') == 'hilang' ? 'selected' : '' }}>Hilang</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="status_pengembalian" class="form-label">Status</label>
                        <select class="form-select" id="status_pengembalian" name="status_pengembalian">
                            <option value="">Semua Status</option>
                            <option value="menunggu" {{ request('status_pengembalian') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                            <option value="disetujui" {{ request('status_pengembalian') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                            <option value="ditolak" {{ request('status_pengembalian') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group" style="margin-top: 1.5rem;">
                        <div class="filter-buttons">
                            <a href="{{ route('laporan.pengembalian') }}" class="btn-reset">
                                <i class="bi bi-arrow-counterclockwise btn-icon"></i> Reset
                            </a>
                            <button type="submit" name="export" value="excel" class="btn-export">
                                <i class="bi bi-file-earmark-excel-fill btn-icon"></i> Export Excel
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
                    <th>Kondisi</th>
                    <th>Biaya Denda</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pengembalians as $index => $pengembalian)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $pengembalian->peminjaman->user->name ?? 'User tidak ditemukan' }}</td>
                    <td>{{ $pengembalian->peminjaman->barang->nama_barang ?? 'Barang tidak ditemukan' }}</td>
                    <td>{{ $pengembalian->jumlah_kembali }}</td>
                    <td>{{ $pengembalian->peminjaman->tanggal_pinjam ? \Carbon\Carbon::parse($pengembalian->peminjaman->tanggal_pinjam)->format('d M Y') : '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($pengembalian->tanggal_pengembalian)->format('d M Y') }}</td>
                    <td>
                        <span class="badge badge-{{ $pengembalian->kondisi_barang }}">
                            {{ ucfirst($pengembalian->kondisi_barang) }}
                        </span>
                    </td>
                    <td>Rp {{ number_format($pengembalian->biaya_denda, 0, ',', '.') }}</td>
                    <td>
                        <span class="badge badge-{{ $pengembalian->status }}">
                            {{ ucfirst($pengembalian->status) }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center py-4">
                        <div class="empty-state">
                            <i class="bi bi-inbox"></i>
                            <h5>Tidak ada data pengembalian</h5>
                            <p>Tidak ada data pengembalian yang sesuai dengan filter yang dipilih.</p>
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

