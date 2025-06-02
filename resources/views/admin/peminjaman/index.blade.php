@extends('layouts.app')

@section('title', 'Data Peminjaman')

@section('styles')
<style>
    h2 {
        margin-bottom: 20px;
        color: #4b3f2f;
    }

    .table-container {
        background: #fff;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 12px;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 10px 14px;
        text-align: left;
    }

    th {
        background-color: #bda89a;
        color: white;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .text-center {
        text-align: center;
    }

    .btn {
        padding: 6px 12px;
        border: none;
        border-radius: 6px;
        font-size: 14px;
        cursor: pointer;
        margin-right: 5px;
    }

    .btn-primary {
        background-color: #7d5fff;
        color: white;
    }

    .btn-primary:hover {
        background-color: #5a3fee;
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
    
    .btn-group {
        display: flex;
    }
</style>
@endsection

@section('content')
<div class="table-container">
    <h2>Daftar Permintaan Peminjaman</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Peminjam</th>
                <th>Barang</th>
                <th>Tanggal Pinjam</th>
                <th>Jumlah</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($peminjamans as $index => $peminjaman)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $peminjaman->user->name }}</td>
                    <td>{{ $peminjaman->barang->nama }}</td>
                    <td>{{ $peminjaman->tanggal_pinjam }}</td>
                    <td>{{ $peminjaman->jumlah }}</td>
                    <td>{{ ucfirst($peminjaman->status) }}</td>
                    <td>
                        <div class="btn-group">
                            @if($peminjaman->status == 'menunggu')
                                <form action="{{ route('admin.peminjaman.approve', $peminjaman->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Setuju</button>
                                </form>
                                <form action="{{ route('admin.peminjaman.reject', $peminjaman->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Tolak</button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak ada permintaan peminjaman.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
