@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white py-3">
                    <div class="d-flex align-items-center">
                        <a href="{{ route('admin.user.index') }}" class="btn btn-sm btn-outline-secondary me-3">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <h5 class="mb-0 fw-bold">
                            <i class="fas fa-user-edit me-2"></i> Edit User
                        </h5>
                    </div>
                </div>
                
                <div class="card-body p-4">
                    <form action="{{ route('admin.user.update', $user) }}" method="POST" class="text-center">
                        @csrf
                        @method('PUT')
                        
                        <div class="text-center mb-4">
                            <div class="avatar-placeholder mb-3">
                                <i class="fas fa-user-circle fa-5x text-secondary"></i>
                            </div>
                        </div>
                        
                        <div class="form-group row justify-content-center mb-4">
                            <label class="col-md-12 text-center mb-2 fw-bold">Nama Lengkap</label>
                            <div class="col-md-8">
                                <input type="text" name="name" class="form-control text-center @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row justify-content-center mb-4">
                            <label class="col-md-12 text-center mb-2 fw-bold">Email</label>
                            <div class="col-md-8">
                                <input type="email" name="email" class="form-control text-center @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row justify-content-center mb-4">
                            <label class="col-md-12 text-center mb-2 fw-bold">Password <span class="text-muted">(Kosongkan jika tidak ingin mengubah password)</span></label>
                            <div class="col-md-8">
                                <input type="password" name="password" class="form-control text-center @error('password') is-invalid @enderror">
                                @error('password')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row justify-content-center mb-4">
                            <label class="col-md-12 text-center mb-2 fw-bold">Role</label>
                            <div class="col-md-8">
                                <select name="role" class="form-select text-center @error('role') is-invalid @enderror">
                                    <option value="admin" {{ $user->hasRole('admin') ? 'selected' : '' }}>Admin</option>
                                    <option value="user" {{ $user->hasRole('user') ? 'selected' : '' }}>User</option>
                                </select>
                                @error('role')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group text-center mt-5">
                            <button type="submit" class="btn btn-primary px-4 py-2">
                                <i class="fas fa-save me-2"></i> Simpan Perubahan
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
    }
    
    .container {
        max-width: 800px;
        margin: 40px auto;
    }
    
    .card {
        border-radius: 15px;
        border: none;
        box-shadow: 0 4px 20px rgba(180, 138, 90, 0.07);
        background: #fffaf0;
        overflow: hidden;
    }
    
    .card-header {
        background-color: #fdf6ee;
        border-bottom: 1px solid #e2d9c5;
        padding: 18px 24px;
    }
    
    .btn-outline-secondary {
        color: #8b6f4e;
        border: 1.5px solid #d8cbb3;
        background-color: transparent;
        border-radius: 8px;
        padding: 0.5rem 1rem;
        font-weight: 500;
        transition: all 0.2s;
    }
    
    .btn-outline-secondary:hover {
        background-color: #f8f3ea;
        color: #b48a5a;
        border-color: #c8b48d;
    }
    
    .fw-bold {
        color: #b48a5a;
    }
    
    .card-body {
        padding: 2rem;
    }
    
    .form-control, .form-select {
        background: #f8f3ea;
        border: 1.5px solid #f1e3d3;
        color: #8b6f4e;
        font-weight: 500;
        border-radius: 8px;
        padding: 0.7rem 1rem;
        transition: all 0.3s;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #c8b48d;
        box-shadow: 0 0 0 0.2rem rgba(200, 180, 141, 0.2);
        background-color: #fffefb;
    }
    
    .text-secondary {
        color: #a39b91 !important;
    }
    
    .text-muted {
        color: #a39b91 !important;
        font-size: 0.85rem;
    }
    
    .btn-primary {
        background-color: #c7a86d;
        border: none;
        font-weight: 500;
        padding: 0.7rem 1.5rem;
        border-radius: 8px;
        transition: background-color 0.2s;
    }
    
    .btn-primary:hover {
        background-color: #b48a5a;
    }
    
    .invalid-feedback {
        color: #d9534f;
        font-size: 0.85rem;
    }
    
    .form-group {
        margin-bottom: 1.8rem;
    }
    
    label.fw-bold {
        font-weight: 600 !important;
        color: #8b6f4e;
        margin-bottom: 0.5rem;
    }
</style>
@endsection
