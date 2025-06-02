@extends('layouts.app')

@section('content')
    <style>
        body {
            background-color: #fefaf3;
        }

        .form-container {
            background: #fffaf0;
            border-radius: 12px;
            padding: 3rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            border: 1px solid #e2d9c5;
            max-width: 700px;
            margin: 0;
            margin-left: auto;
            margin-right: auto;
        }

        .form-title {
            font-size: 1.75rem;
            font-weight: 600;
            margin-bottom: 2rem;
            color: #4a4a4a;
        }

        label {
            font-weight: 500;
            color: #555;
            margin-bottom: 0.5rem;
        }

        .form-control {
            border-radius: 6px;
            border: 1px solid #d8cbb3;
            background-color: #fffefb;
            box-shadow: none;
            color: #3f3f3f;
            padding: 0.75rem;
        }

        .form-control:focus {
            border-color: #c8b48d;
            box-shadow: 0 0 0 0.2rem rgba(200, 180, 141, 0.2);
        }

        .form-group {
            margin-bottom: 2rem;
        }

        .btn-primary {
            background-color: #c7a86d;
            border: none;
            font-weight: 500;
            padding: 0.6rem 1.4rem;
            border-radius: 6px;
        }

        .btn-secondary {
            background-color: #a39b91;
            border: none;
            font-weight: 500;
            padding: 0.6rem 1.4rem;
            border-radius: 6px;
        }

        .btn:hover {
            opacity: 0.95;
        }

        .container {
            display: flex;
            justify-content: flex-start;
            align-items: flex-start;
            margin-top: 5rem;
        }

        @media (max-width: 576px) {
            .form-container {
                padding: 2rem;
            }
        }
    </style>

    <div class="container">
        @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
        <div class="form-container">
            <div class="form-title">Tambah Barang</div>

            <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="nama">Nama Barang</label>
                    <input type="text" name="nama" id="nama" class="form-control"
                        placeholder="Masukkan nama barang" required>
                </div>

                <div class="form-group">
                    <label for="jumlah_barang">Jumlah Barang</label>
                    <input type="number" name="jumlah_barang" id="jumlah_barang" class="form-control" min="0"
                        required>
                </div>

                <div class="form-group">
                    <label for="id_kategori">Kategori</label>
                    <select name="id_kategori" id="id_kategori" class="form-control" required>
                        <option value="">Pilih Kategori</option>
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="foto">Foto Barang</label>
                    <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
                </div>

                <div class="text-start">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('barang.index') }}" class="btn btn-secondary ms-2">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
