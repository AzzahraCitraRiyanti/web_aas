@extends('layouts.app')

@section('title', 'Data Pengembalian')

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
    }

    .btn-primary {
        background-color: #7d5fff;
        color: white;
    }

    .btn-primary:hover {
        background-color: #5a3fee;
    }
</style>
@endsection

@section('content')
<div class="table-container">
    <h2>Daftar Permintaan Pengembalian</h2>

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
                    <td>{{ $pengembalian->tanggal_pengembalian }}</td>
                    <td>{{ $pengembalian->jumlah_kembali }}</td>
                    <td>{{ ucfirst($pengembalian->status) }}</td>
                    <td>
                        @if($pengembalian->status == 'menunggu')
                            <div class="btn-group">
                                <form action="{{ route('pengembalian.approve', $pengembalian->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-success me-2">Approve</button>
                                </form>
                                <form action="{{ route('pengembalian.reject', $pengembalian->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Reject</button>
                                </form>
                            </div>
                        @else
                            <span class="text-muted">Sudah diproses</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak ada permintaan pengembalian.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

