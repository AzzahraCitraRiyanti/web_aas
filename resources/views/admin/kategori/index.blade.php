@extends('layouts.app')

@section('content')
    <style>
        body {
            background: #f8f5f0 !important;
        }

        .container-box {
            max-width: 1000px;
            margin: 40px auto;
            background: #fffdfa;
            border-radius: 12px;
            box-shadow: 0 2px 14px rgba(0, 0, 0, 0.05);
            padding: 2.5rem;
        }

        .title {
            font-size: 1.6rem;
            font-weight: 600;
            color: #5a4635;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .alert-success {
            max-width: 1000px;
            margin: 20px auto;
            padding: 1rem 1.5rem;
            border-radius: 8px;
            background: #e1f3e8;
            color: #2e7d4f;
            border: 1px solid #c4e2cd;
        }

        .alert-error {
            max-width: 1000px;
            margin: 20px auto;
            padding: 1rem 1.5rem;
            border-radius: 8px;
            background: #f8d7da;
            color: #842029;
            border: 1px solid #f5c2c7;
        }

        .btn-add {
            background: #e9e2d8;
            color: #5a4635;
            font-weight: 600;
            border: none;
            border-radius: 6px;
            padding: 0.6rem 1.2rem;
            font-size: 0.95rem;
            margin-bottom: 1.5rem;
            display: inline-block;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .btn-add:hover {
            background: #dcd2c6;
            color: #4e3e30;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.95rem;
            color: #4d3d31;
        }

        th,
        td {
            padding: 0.75rem 1rem;
            border: 1px solid #e8e0d4;
            text-align: center;
        }

        thead {
            background-color: #f1e9df;
        }

        tbody tr:nth-child(odd) {
            background-color: #fdf9f4;
        }

        tbody tr:nth-child(even) {
            background-color: #fbf7f0;
        }

        .btn {
            padding: 0.4rem 0.9rem;
            font-size: 0.88rem;
            border-radius: 6px;
            font-weight: 500;
            border: none;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .btn-edit {
            background-color: #eee6da;
            color: #5a4635;
            border: 1px solid #e0d6c6;
        }

        .btn-edit:hover {
            background-color: #e1d9cd;
        }

        .btn-delete {
            background-color: #f2dede;
            color: #a94442;
            border: 1px solid #ebcccc;
        }

        .btn-delete:hover {
            background-color: #e6c8c8;
        }

        .text-muted {
            color: #888;
            font-style: italic;
        }
    </style>

    @if (session('success'))
        <div class="alert-success">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert-error">
            <i class="bi bi-exclamation-triangle"></i> {{ session('error') }}
        </div>
    @endif

    <div class="container-box">
        <h2 class="title"><i class="bi bi-tags"></i> Daftar Kategori</h2>

        <a href="{{ route('kategori.create') }}" class="btn-add">
            <i class="bi bi-plus-circle"></i> Tambah Kategori
        </a>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th style="width: 60px;">No</th>
                        <th style="width: 40%;">Nama Kategori</th>
                        <th style="width: 20%;">Tanggal Dibuat</th>
                        <th style="width: 200px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kategoris as $index => $kategori)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $kategori->nama }}</td>
                            <td>{{ $kategori->created_at->format('d M Y') }}</td>
                            <td>
                                <div style="display: flex; justify-content: center; gap: 10px;">
                                    <a href="{{ route('kategori.edit', $kategori->id) }}" class="btn btn-edit">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-delete">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-muted">Belum ada kategori.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
