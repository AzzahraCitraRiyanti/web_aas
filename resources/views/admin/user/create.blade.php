@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="mb-4">
                <a href="{{ route('admin.user.index') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
            
            <div class="card shadow-sm">
                <div class="card-header">
                    <h4 class="mb-0"><i class="fas fa-user-plus me-2"></i> Tambah User Baru</h4>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('admin.user.store') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                    id="name" name="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                    id="email" name="email" value="{{ old('email') }}" placeholder="Masukkan alamat email" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                    id="password" name="password" placeholder="Masukkan password" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" class="form-control" 
                                    id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi password" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="role" class="form-label">Role</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                                <select class="form-select @error('role') is-invalid @enderror" 
                                    id="role" name="role" required>
                                    <option value="">Pilih Role</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>
                                            {{ ucfirst($role->name) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <a href="{{ route('admin.user.index') }}" class="btn btn-outline-secondary me-md-2">
                                <i class="fas fa-times me-1"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    body {
        background-color: #fefaf3;
        line-height: 1.6;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 600px;
        margin-left: 40px; /* ke kiri */
        margin-top: 20px;  /* lebih ke atas */
        margin-right: auto;
        padding: 0 16px;
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        color: #8b6f4e;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.2s;
        padding: 10px 0;
        margin-bottom: 24px;
        font-size: 1rem;
    }

    .btn-back i {
        margin-right: 10px;
    }

    .btn-back:hover {
        color: #b48a5a;
    }

    .card {
        border-radius: 14px;
        border: none;
        box-shadow: 0 4px 16px rgba(180, 138, 90, 0.08);
        background: #fffaf0;
        overflow: hidden;
    }

    .card-header {
        background-color: #fdf6ee;
        border-bottom: 1px solid #e2d9c5;
        padding: 20px 24px;
    }

    .card-header h4 {
        color: #b48a5a;
        font-weight: 700;
        font-size: 1.4rem;
        margin: 0;
    }

    .card-body {
        padding: 2rem 2rem 1.8rem 2rem;
    }

    .form-label {
        font-weight: 600;
        color: #8b6f4e;
        margin-bottom: 0.5rem;
        display: block;
        font-size: 0.95rem;
    }

    .input-group {
        margin-bottom: 1.6rem;
    }

    .input-group-text {
        background-color: #f8f3ea;
        border: 1.5px solid #f1e3d3;
        color: #8b6f4e;
        padding: 0.6rem 1rem;
        font-size: 0.9rem;
    }

    .form-control,
    .form-select {
        background: #f8f3ea;
        border: 1.5px solid #f1e3d3;
        color: #8b6f4e;
        font-weight: 500;
        border-radius: 8px;
        padding: 0.6rem 1rem;
        font-size: 0.95rem;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #c8b48d;
        box-shadow: 0 0 0 0.2rem rgba(200, 180, 141, 0.2);
        background-color: #fffefb;
    }

    .btn-primary {
        background-color: #c7a86d;
        border: none;
        font-weight: 500;
        padding: 0.65rem 1.4rem;
        border-radius: 8px;
        font-size: 0.95rem;
    }

    .btn-primary:hover {
        background-color: #b48a5a;
    }

    .btn-outline-secondary {
        color: #8b6f4e;
        border: 1.5px solid #d8cbb3;
        background-color: transparent;
        border-radius: 8px;
        padding: 0.65rem 1.4rem;
        font-size: 0.95rem;
    }

    .btn-outline-secondary:hover {
        background-color: #f8f3ea;
        color: #b48a5a;
        border-color: #c8b48d;
    }

    .form-group {
        margin-bottom: 1.6rem;
    }
</style>

@endsection
