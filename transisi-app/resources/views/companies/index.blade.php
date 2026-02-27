@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center bg-white">
                    <h5 class="mb-0">{{ __('Daftar Perusahaan') }}</h5>
                    <a href="{{ route('companies.create') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-lg"></i> Tambah Company
                    </a>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Logo</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Website</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($companies as $company)
                                    <tr>
                                        <td>
                                            @if($company->logo)
                                                <img src="{{ asset('storage/'.$company->logo) }}" 
                                                     alt="Logo" class="rounded border" 
                                                     style="width: 50px; height: 50px; object-fit: cover;">
                                            @else
                                                <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                                     style="width: 50px; height: 50px;">
                                                    <span class="text-muted" style="font-size: 10px;">No Logo</span>
                                                </div>
                                            @endif
                                        </td>
                                        <td><strong>{{ $company->name }}</strong></td>
                                        <td>{{ $company->email ?? '-' }}</td>
                                        <td>
                                            <a href="{{ $company->website }}" target="_blank" class="text-decoration-none">
                                                {{ $company->website ?? '-' }}
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('companies.edit', $company->id) }}" 
                                                   class="btn btn-outline-warning btn-sm">Edit</a>
                                                
                                                <form action="{{ route('companies.destroy', $company->id) }}" 
                                                      method="POST" 
                                                      onsubmit="return confirm('Yakin ingin menghapus?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-muted">
                                            Belum ada data perusahaan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        {{ $companies->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection