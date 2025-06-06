@extends('layouts.app')

@section('title', 'Data Pengembalian')

@section('styles')
<style>
    /* Styling dasar */
    body {
        background-color: #f8f9fa;
    }
    
    /* Header */
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
    
    /* Tombol tambah */
    .btn-add {
        background-color: #7d5fff;
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        font-size: 0.9rem;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        margin-bottom: 1rem;
        text-decoration: none;
        transition: background-color 0.2s;
    }
    
    .btn-add i {
        margin-right: 0.5rem;
        font-size: 0.9rem;
    }
    
    .btn-add:hover {
        background-color: #6a4ddb;
        color: white;
        text-decoration: none;
    }
    
    /* Tabel */
    .table-container {
        background: #fff;
        border-radius: 10px;
        padding: 1.5rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        overflow-x: auto;
    }
    
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 0;
    }
    
    th {
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
    
    td {
        padding: 0.75rem 1rem;
        border-bottom: 1px solid #dee2e6;
        vertical-align: middle;
        font-size: 0.9rem;
    }
    
    tr:hover {
        background-color: #f8f9fa;
    }
    
    tr:last-child td {
        border-bottom: none;
    }
    
    /* Badge status */
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
    
    /* Tombol aksi */
    .btn-group {
        display: flex;
        gap: 8px;
        justify-content: center;
    }
    
    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.4rem 0.75rem;
        border-radius: 6px;
        border: none;
        font-size: 0.8rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .btn-success {
        background-color: #28a745;
        color: white;
    }
    
    .btn-success:hover {
        background-color: #218838;
    }
    
    .btn-danger {
        background-color: #dc3545;
        color: white;
    }
    
    .btn-danger:hover {
        background-color: #c82333;
    }
    
    .btn-primary {
        background-color: #4f46e5;
        color: white;
    }
    
    .btn-primary:hover {
        background-color: #4338ca;
    }
    
    .btn i {
        margin-right: 4px;
        font-size: 0.8rem;
    }
    
    /* Empty state */
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
        .btn-group {
            flex-direction: column;
            gap: 4px;
        }
    }
</style>
@endsection

@section('content')
<div class="container py-4">
    <div class="page-header">
        <h2>Data Pengembalian Barang</h2>
        <p class="text-muted">Kelola data pengembalian barang</p>
    </div>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pengembali</th>
                    <th>Barang</th>
                    <th>Tanggal Kembali</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pengembalians as $index => $pengembalian)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $pengembalian->peminjaman->user->name }}</td>
                        <td>{{ $pengembalian->peminjaman->barang->nama_barang }}</td>
                        <td>{{ \Carbon\Carbon::parse($pengembalian->tanggal_pengembalian)->format('d M Y') }}</td>
                        <td>{{ $pengembalian->jumlah_kembali }}</td>
                        <td>
                            <span class="badge badge-{{ $pengembalian->status }}">
                                {{ ucfirst($pengembalian->status) }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group">
                                @if($pengembalian->status == 'menunggu')
                                    <form action="{{ route('pengembalian.approve', $pengembalian->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success">
                                            <i class="bi bi-check-circle"></i> Setuju
                                        </button>
                                    </form>
                                    <form action="{{ route('pengembalian.reject', $pengembalian->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">
                                            <i class="bi bi-x-circle"></i> Tolak
                                        </button>
                                    </form>
                                @endif
                                <a href="{{ route('pengembalian.show', $pengembalian->id) }}" class="btn btn-primary">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">
                            <div class="empty-state">
                                <i class="bi bi-inbox"></i>
                                <h5>Tidak ada data pengembalian</h5>
                                <p>Data pengembalian akan muncul di sini setelah ada pengembalian barang.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

