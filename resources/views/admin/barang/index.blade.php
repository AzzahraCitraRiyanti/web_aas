@extends('layouts.app')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #f8f5f0 !important;
        }

        .table-card {
            max-width: 1000px;
            margin: 40px auto;
            background: #fffdfa;
            border-radius: 12px;
            box-shadow: 0 2px 14px rgba(0, 0, 0, 0.04);
            padding: 2rem;
        }

        .table-title {
            font-weight: 600;
            font-size: 1.4rem;
            color: #5a4635;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .btn-add {
            background: #e9e2d8;
            color: #5a4635;
            font-weight: 600;
            border: none;
            border-radius: 6px;
            padding: 0.5rem 1.1rem;
            font-size: 0.95rem;
            margin-top: 1rem;
            margin-bottom: 1.5rem;
            display: inline-block;
            transition: background 0.2s ease;
            text-decoration: none;
        }

        .btn-add:hover {
            background: #dcd2c6;
            color: #4e3e30;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.96rem;
            color: #4d3d31;
        }

        th,
        td {
            padding: 0.75rem 1rem;
            border: 1px solid #e8e0d4;
            text-align: center;
            vertical-align: middle;
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

        .btn-action {
            font-size: 0.88rem;
            padding: 0.35rem 0.75rem;
            border-radius: 6px;
            font-weight: 500;
            border: none;
            cursor: pointer;
        }

        .btn-edit {
            background-color: #eee6da;
            color: #5a4635;
            border: 1px solid #e0d6c6;
            text-decoration: none;
            display: inline-block;
        }

        .btn-edit:hover {
            background-color: #e1d9cd;
        }

        .btn-delete {
            background-color: #f2dede;
            color: #a94442;
            border: 1px solid #ebcccc;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .btn-delete i {
            font-size: 1.1rem;
        }

        .btn-delete:hover {
            background-color: #e6c8c8;
        }

        .table-footer {
            margin-top: 1rem;
            font-size: 0.9rem;
            color: #777;
            text-align: center;
        }

        /* Search form styling */
        .search-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.75rem;
            flex-wrap: wrap;
            margin-bottom: 1.5rem;
        }

        .search-form {
            display: flex;
            gap: 0.5rem;
            border-radius: 30px;
            overflow: hidden;
            background-color: #fffdfa;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .search-input {
            flex-grow: 1;
            border: none;
            padding: 0.6rem 1.2rem;
            font-size: 1rem;
            font-weight: 500;
            color: #5a4635;
            outline: none;
        }

        .search-input::placeholder {
            color: #b5a886;
            font-style: italic;
        }

        .search-button {
            background-color: #c7a86d;
            border: none;
            color: white;
            padding: 0 1.5rem;
            cursor: pointer;
            font-weight: 700;
            font-size: 1rem;
            transition: background-color 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .search-button:hover {
            background-color: #a78544;
        }

        .search-button i {
            margin-left: 6px;
            font-size: 1.2rem;
        }

        .btn-reset {
            background-color: transparent;
            color: #7a6248;
            border: none;
            padding: 0.45rem 1rem;
            border-radius: 30px;
            font-weight: 600;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }

        .btn-reset:hover {
            background-color: #e0d2c2;
            color: #5a4635;
        }

        .aksi-flex {
            display: flex;
            gap: 0.5rem;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
        }

        .aksi-flex form {
            margin: 0;
            display: inline;
        }

        /* Success alert style */
        .alert-success {
            max-width: 1000px;
            margin: 20px auto;
            padding: 1rem 1.5rem;
            border-radius: 8px;
            background: #e1f3e8;
            color: #2e7d4f;
            border: 1px solid #c4e2cd;
        }
    </style>

    <div class="container-fluid">
        <div class="table-card card">
            <div class="card-body">

                {{-- Alert Success --}}
                @if (session('success'))
                    <div class="alert-success">
                        <i class="bi bi-check-circle"></i> {{ session('success') }}
                    </div>
                @endif

                <h2 class="table-title">
                    <i class="bi bi-box"></i> Daftar Barang
                </h2>

                <div class="search-wrapper">
                    <form action="{{ route('barang.index') }}" method="GET" class="search-form">
                        <input type="text" name="search" class="search-input" placeholder="Cari barang..."
                            value="{{ request('search') }}">
                        <button type="submit" class="search-button">
                            <i class="bi bi-search"></i>
                        </button>
                    </form>
                    @if (request('search'))
                        <a href="{{ route('barang.index') }}" class="btn-reset">
                            <i class="bi bi-x-circle"></i> Reset
                        </a>
                    @endif
                </div>

                <a href="{{ route('barang.create') }}" class="btn-add mb-3">
                    <i class="bi bi-plus-lg"></i> Tambah Barang
                </a>

                @if ($barang->isEmpty())
                    <div class="alert alert-warning text-center">
                        Belum ada barang yang tersedia.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered align-middle mb-0 w-100">
                            <thead>
                                <tr>
                                    <th style="width: 50px;">No</th>
                                    <th>Nama Barang</th>
                                    <th>Kategori</th>
                                    <th>Jumlah</th>
                                    <th>Foto</th>
                                    <th>Tanggal</th>
                                    <th style="width: 200px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($barang as $index => $b)
                                    <tr>
                                        <td>{{ $barang->firstItem() + $index }}</td>
                                        <td>{{ $b->nama }}</td>
                                        <td>{{ $b->kategori->nama ?? '-' }}</td>
                                        <td>{{ $b->jumlah_barang ?? 0 }}</td>
                                        <td>
                                            @if ($b->foto)
                                                <img src="{{ asset('storage/' . $b->foto) }}" alt="Foto Barang"
                                                    style="width: 50px; height: 50px; object-fit: cover;">
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($b->created_at)->format('d M, Y') }}</td>
                                        <td>
                                            <div class="aksi-flex">
                                                <a href="{{ route('barang.edit', $b->id) }}" class="btn-edit btn-action">
                                                    Edit
                                                </a>
                                                <form action="{{ route('barang.destroy', $b->id) }}" method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus barang ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-delete btn-action">
                                                        <i class="bi bi-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="table-footer">
                        {{ $barang->withQueryString()->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
