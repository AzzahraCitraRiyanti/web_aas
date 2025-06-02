@extends('layouts.app')

@section('content')
    <style>
        .content {
            background: #f8f5f0;
            padding: 2rem 1rem;
        }

        .table-card {
            max-width: 1000px;
            margin: 0 auto;
            background: #fffdfa;
            border-radius: 12px;
            box-shadow: 0 2px 14px rgba(0, 0, 0, 0.04);
            padding: 2.5rem;
        }

        .table-title {
            font-weight: 700;
            font-size: 1.7rem;
            color: #4a3a2b;
            text-align: center;
            margin-bottom: 1.2rem;
        }

        .title-divider {
            width: 60px;
            height: 3px;
            background: #bba78a;
            margin: 0 auto 1.5rem auto;
            border-radius: 5px;
        }

        .btn-add {
            background: #e9e2d8;
            color: #5a4635;
            font-weight: 600;
            border: none;
            border-radius: 6px;
            padding: 0.5rem 1.1rem;
            font-size: 0.95rem;
            display: block;
            margin: 0 auto 2rem auto;
            transition: background 0.2s ease;
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
            border: 1px solid #d8cfc3;
        }

        th,
        td {
            padding: 0.75rem 1rem;
            border: 1px solid #d8cfc3;
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

        .btn-edit {
            background-color: #eee6da;
            color: #5a4635;
            border: 1px solid #e0d6c6;
            font-size: 0.88rem;
            padding: 0.35rem 0.75rem;
            border-radius: 6px;
        }

        .btn-edit:hover {
            background-color: #e1d9cd;
        }

        .btn-delete {
            background-color: #f2dede;
            color: #a94442;
            border: 1px solid #ebcccc;
            font-size: 0.88rem;
            padding: 0.35rem 0.75rem;
            border-radius: 6px;
        }

        .btn-delete:hover {
            background-color: #e6c8c8;
        }
    </style>

    <div class="table-card">
        <h2 class="table-title">
            <i class="bi bi-bar-chart-line"></i> Data Stok Barang
        </h2>
        <div class="title-divider"></div>

        {{-- <a href="{{ route('stock.create') }}" class="btn btn-add">+ Tambah Stock</a> --}}

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        {{-- <th>Aksi</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @forelse($stocks as $stock)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $stock->barangs->nama ?? '-' }}</td>
                            <td>{{ $stock->jumlah }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-muted text-center">Tidak ada data stok.</td>
                        </tr>
                    @endforelse


                </tbody>
            </table>
        </div>
    </div>
@endsection
