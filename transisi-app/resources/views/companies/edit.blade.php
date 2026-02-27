@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-primary">Edit Perusahaan: {{ $company->name }}</h5>
                    <a href="{{ route('companies.index') }}" class="btn btn-light btn-sm">Kembali</a>
                </div>

                <div class="card-body">
                    {{-- URL Action mengarah ke update dengan ID company --}}
                    <form action="{{ route('companies.update', $company->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') {{-- PENTING: Untuk method update --}}

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Perusahaan <span class="text-danger">*</span></label>
                            {{-- old('name', $company->name) artinya: pakai inputan terakhir, kalau kosong pakai data DB --}}
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $company->name) }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Perusahaan <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $company->email) }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="logo" class="form-label">Logo Perusahaan (PNG, Min 100x100px)</label>
                            
                            {{-- Tampilkan Logo Lama --}}
                            <div class="mb-2">
                                @if($company->logo)
                                    <img src="{{ asset('storage/'.$company->logo) }}" alt="Current Logo" class="img-thumbnail" style="width: 80px; height: 80px; object-fit: cover;">
                                    <div class="small text-muted">Logo saat ini</div>
                                @endif
                            </div>

                            <input type="file" name="logo" id="logo" class="form-control @error('logo') is-invalid @enderror">
                            <small class="text-muted">Kosongkan jika tidak ingin mengubah logo. (Maks 2MB)</small>
                            @error('logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="website" class="form-label">Website <span class="text-danger">*</span></label>
                            <input type="url" name="website" id="website" class="form-control @error('website') is-invalid @enderror" value="{{ old('website', $company->website) }}">
                            @error('website')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-warning">
                                Perbarui Data Perusahaan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection