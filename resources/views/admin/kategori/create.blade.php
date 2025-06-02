@extends('layouts.app')

@section('content')
    <style>
        body {
            background: #f9f7f3 !important;
        }

        .form-wrapper {
            max-width: 700px;
            margin: 48px auto 0 40px;
            /* kiri 40px, atas 48px, tidak center */
        }

        .form-card {
            border-radius: 14px;
            box-shadow: 0 4px 24px rgba(180, 138, 90, 0.07);
            border: none;
            background: #fdf6ee;
            padding: 0;
        }

        .form-card .card-body {
            padding: 2rem 2.2rem 1.5rem 2.2rem;
        }

        .form-title {
            font-weight: 700;
            color: #b48a5a;
            margin-bottom: 1.5rem;
            font-size: 1.4rem;
            letter-spacing: 1px;
        }

        .form-label {
            font-weight: 600;
            color: #8b6f4e;
            font-size: 1rem;
            margin-bottom: 0.5rem;
            display: block;
        }

        .form-control {
            background: #f8f3ea;
            border: 1.5px solid #f1e3d3;
            color: #8b6f4e;
            font-weight: 500;
            border-radius: 8px;
            font-size: 1rem;
            padding: 0.6rem 1rem;
            margin-bottom: 1.1rem;
            min-height: 44px;
        }

        .form-control:focus {
            border-color: #b48a5a;
            box-shadow: 0 0 0 0.13rem rgba(180, 138, 90, 0.12);
            background: #f6e7d8;
            color: #8b6f4e;
        }

        .btn-success {
            background: linear-gradient(90deg, #f6e7d8 60%, #fdf6ee 100%);
            color: #b48a5a;
            border: none;
            font-weight: 600;
            font-size: 1rem;
            padding: 0.6rem 1.6rem;
            border-radius: 7px;
            transition: background 0.18s, color 0.18s;
            box-shadow: 0 2px 10px rgba(180, 138, 90, 0.06);
            display: inline-flex;
            align-items: center;
            gap: 7px;
        }

        .btn-success:hover {
            background: linear-gradient(90deg, #fbeedc 60%, #f6e7d8 100%);
            color: #a67c52;
        }

        .btn-secondary {
            border-radius: 7px;
            font-weight: 600;
            font-size: 1rem;
            margin-left: 12px;
            background: #f8f3ea;
            color: #b48a5a;
            border: 1.5px solid #f1e3d3;
            transition: background 0.18s, color 0.18s;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 0.6rem 1.6rem;
        }

        .btn-secondary:hover {
            background: #f6e7d8;
            color: #a67c52;
        }

        .d-flex.justify-content-end {
            gap: 0.5rem;
            margin-top: 0.2rem;
        }

        @media (max-width: 900px) {
            .form-wrapper {
                max-width: 95vw;
                margin-left: 0.7rem;
                margin-right: 0.7rem;
            }

            .form-card .card-body {
                padding: 1.2rem 0.7rem 1rem 0.7rem;
            }
        }
    </style>

    <div class="form-wrapper">
        <div class="card form-card">
            <div class="card-body">
                <div class="form-title">
                    <i class="bi bi-tags"></i> Tambah Kategori
                </div>
                <form action="{{ route('kategori.store') }}" method="POST">
                    @csrf

                    <label for="nama" class="form-label">Nama Kategori</label>
                    <input type="text" name="nama" id="nama" class="form-control"
                        placeholder="Masukkan nama kategori" required autofocus>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle"></i> Simpan
                        </button>
                        <a href="{{ route('kategori.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
