@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
                    <h5 class="mb-0 fw-bold text-dark">
                        <i class="bi bi-people-fill me-2 text-primary"></i> Daftar Karyawan
                    </h5>
                    <div class="btn-group gap-2">
                        <a href="{{ route('employees.create') }}" class="btn btn-primary btn-sm rounded-2">
                            <i class="bi bi-plus-lg"></i> Tambah
                        </a>
                        <button type="button" class="btn btn-success btn-sm rounded-2 text-white" data-bs-toggle="modal" data-bs-target="#modalImport">
                            <i class="bi bi-file-earmark-excel"></i> Import
                        </button>
                        <a href="{{ route('employees.export') }}" class="btn btn-outline-secondary btn-sm rounded-2">
                            <i class="bi bi-download"></i> Export PDF
                        </a>
                    </div>
                </div>

                <div class="card-body p-0">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light text-muted small text-uppercase">
                                <tr>
                                    <th class="ps-4" style="width: 30%">Nama Karyawan</th>
                                    <th style="width: 25%">Perusahaan</th>
                                    <th style="width: 25%">Email</th>
                                    <th class="text-center" style="width: 20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($employees as $employee)
                                    <tr>
                                        <td class="ps-4">
                                            <div class="fw-bold text-dark">{{ $employee->name }}</div>
                                            <small class="text-muted">ID: {{ substr($employee->id, 0, 8) }}...</small>
                                        </td>
                                        <td>
                                            <span class="badge rounded-pill bg-info-subtle text-info border border-info-subtle px-3 py-2">
                                                <i class="bi bi-building me-1"></i> {{ $employee->company->name ?? 'N/A' }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="mailto:{{ $employee->email }}" class="text-decoration-none text-muted">
                                                <i class="bi bi-envelope me-1 small"></i> {{ $employee->email }}
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-1">
                                                <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-sm btn-outline-warning">
                                                    <i class="bi bi-pencil-square"></i> Edit
                                                </a>
                                                <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" onsubmit="return confirm('Hapus karyawan ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                                        <i class="bi bi-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-5">
                                            <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" alt="No data" style="width: 80px; opacity: 0.5">
                                            <p class="mt-3 text-muted">Belum ada data karyawan yang tersimpan.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer bg-white border-top-0 py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">Menampilkan {{ $employees->count() }} data</small>
                            {{ $employees->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade shadow" id="modalImport" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header bg-success text-white py-3">
                <h5 class="modal-title fw-bold">
                    <i class="bi bi-cloud-arrow-up-fill me-2"></i> Import dari Excel/CSV
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('employees.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-4">
                        <label class="form-label fw-bold small text-uppercase text-muted">1. Target Perusahaan</label>
                        <select name="company_id" id="import_company_select" class="form-select border-2" required style="width: 100%"></select>
                    </div>

                    <div class="d-flex align-items-center mb-4">
                        <hr class="flex-grow-1">
                        <span class="mx-3 text-muted small fw-bold">SUMBER DATA</span>
                        <hr class="flex-grow-1">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold small text-uppercase text-muted">2. Pilih File</label>
                        <input type="file" name="file" id="file" class="form-control border-2" required accept=".xlsx, .xls, .csv">
                        <div class="form-text mt-3 bg-light p-3 rounded border-start border-4 border-warning">
                            <div class="d-flex">
                                <i class="bi bi-lightning-charge-fill text-warning me-2 fs-5"></i>
                                <small class="text-dark">
                                    <strong>Mode Chunking:</strong> Sistem akan mengolah data secara bertahap (per 10 baris) untuk mencegah kegagalan server.
                                </small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-light border-0">
                    <button type="button" class="btn btn-link text-muted text-decoration-none" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success px-4 fw-bold">
                        Mulai Import <i class="bi bi-arrow-right ms-1"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    /* Styling tambahan untuk Select2 agar cocok dengan Bootstrap 5 */
    .select2-container--bootstrap-5 .select2-selection {
        border: 2px solid #dee2e6 !important;
        padding: 0.5rem !important;
        height: auto !important;
    }
    .bg-info-subtle { background-color: #e0f7fa; }
    .text-info { color: #00acc1 !important; }
</style>

<script>
    $(document).ready(function() {
        $('#modalImport').on('shown.bs.modal', function() {
            $('#import_company_select').select2({
                theme: 'bootstrap-5',
                dropdownParent: $('#modalImport'),
                placeholder: 'Ketik nama perusahaan...',
                allowClear: true,
                ajax: {
                    url: "{{ route('companies.api') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return { q: params.term, page: params.page || 1 };
                    },
                    processResults: function(data) {
                        return {
                            results: data.results,
                            pagination: { more: data.pagination.more }
                        };
                    },
                    cache: true
                }
            });
        });
    });
</script>
@endsection
