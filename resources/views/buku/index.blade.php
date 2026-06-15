@extends('layouts.app')

@section('title', 'Daftar Buku')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>
        <i class="bi bi-book"></i>
        Daftar Buku
    </h1>
    <div class="d-flex gap-2">
        {{-- Button Export CSV (Tugas 3) --}}
        <a href="{{ route('buku.export') }}" class="btn btn-success">
            <i class="bi bi-download"></i> Export CSV
        </a>
        <a href="{{ route('buku.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Buku
        </a>
    </div>
</div>

{{-- Statistik Cards --}}
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card border-primary">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Total Buku</h6>
                        <h2 class="mb-0">{{ $totalBuku }}</h2>
                    </div>
                    <div class="text-primary">
                        <i class="bi bi-book-fill" style="font-size: 3rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-success">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Buku Tersedia</h6>
                        <h2 class="mb-0">{{ $bukuTersedia }}</h2>
                    </div>
                    <div class="text-success">
                        <i class="bi bi-check-circle-fill" style="font-size: 3rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-danger">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Buku Habis</h6>
                        <h2 class="mb-0">{{ $bukuHabis }}</h2>
                    </div>
                    <div class="text-danger">
                        <i class="bi bi-x-circle-fill" style="font-size: 3rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Advanced Search Form --}}
<div class="card mb-4 border-info">
    <div class="card-header bg-info text-white">
        <i class="bi bi-search"></i> Advanced Search & Filter
    </div>
    <div class="card-body">
        <form action="{{ route('buku.search') }}" method="GET" class="row g-3">
            <div class="col-md-4">
                <label for="keyword" class="form-label"><i class="bi bi-text-paragraph"></i> Keyword</label>
                <input type="text" class="form-control" id="keyword" name="keyword" placeholder="Judul, Pengarang, Penerbit..." value="{{ request('keyword') }}">
            </div>

            <div class="col-md-3">
                <label for="kategori" class="form-label"><i class="bi bi-tag"></i> Kategori</label>
                <select class="form-select" id="kategori" name="kategori">
                    <option value="">-- Semua Kategori --</option>
                    @foreach ($kategoriList as $kat)
                    <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <label for="tahun" class="form-label"><i class="bi bi-calendar"></i> Tahun</label>
                <select class="form-select" id="tahun" name="tahun">
                    <option value="">-- Semua Tahun --</option>
                    @foreach ($tahunList as $tahun)
                    <option value="{{ $tahun }}" {{ request('tahun') == $tahun ? 'selected' : '' }}>{{ $tahun }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <label for="ketersediaan" class="form-label"><i class="bi bi-check2-square"></i> Ketersediaan</label>
                <select class="form-select" id="ketersediaan" name="ketersediaan">
                    <option value="">-- Semua --</option>
                    <option value="tersedia" {{ request('ketersediaan') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="habis" {{ request('ketersediaan') == 'habis' ? 'selected' : '' }}>Habis</option>
                </select>
            </div>

            <div class="col-md-1">
                <label class="form-label d-block">&nbsp;</label>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-info flex-grow-1 text-white"><i class="bi bi-search"></i></button>
                    <a href="{{ route('buku.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-clockwise"></i></a>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Filter Kategori Quick Buttons --}}
<div class="card mb-4">
    <div class="card-body">
        <h6 class="card-title"><i class="bi bi-funnel"></i> Filter Kategori:</h6>
        <div class="btn-group" role="group">
            <a href="{{ route('buku.index') }}" class="btn btn-sm {{ !isset($kategori) ? 'btn-primary' : 'btn-outline-primary' }}">Semua</a>
            <a href="{{ route('buku.kategori', 'Programming') }}" class="btn btn-sm {{ isset($kategori) && $kategori == 'Programming' ? 'btn-primary' : 'btn-outline-primary' }}">Programming</a>
            <a href="{{ route('buku.kategori', 'Database') }}" class="btn btn-sm {{ isset($kategori) && $kategori == 'Database' ? 'btn-primary' : 'btn-outline-primary' }}">Database</a>
            <a href="{{ route('buku.kategori', 'Web Design') }}" class="btn btn-sm {{ isset($kategori) && $kategori == 'Web Design' ? 'btn-primary' : 'btn-outline-primary' }}">Web Design</a>
            <a href="{{ route('buku.kategori', 'Networking') }}" class="btn btn-sm {{ isset($kategori) && $kategori == 'Networking' ? 'btn-primary' : 'btn-outline-primary' }}">Networking</a>
            <a href="{{ route('buku.kategori', 'Data Science') }}" class="btn btn-sm {{ isset($kategori) && $kategori == 'Data Science' ? 'btn-primary' : 'btn-outline-primary' }}">Data Science</a>
        </div>
    </div>
</div>

{{-- Form Pembungkus Bulk Delete (Tugas 2) --}}
<form id="bulk-delete-form" action="{{ route('buku.bulk-delete') }}" method="POST">
    @csrf

    @if ($bukus->count() > 0)
    <div class="card mb-3 border-danger shadow-sm">
        <div class="card-body d-flex justify-content-between align-items-center py-2">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="select-all" style="transform: scale(1.2); cursor: pointer;">
                <label class="form-check-label text-danger fw-bold ms-2" for="select-all" style="cursor: pointer;">
                    Pilih Semua Buku
                </label>
            </div>
            <button type="button" id="btn-bulk-delete" class="btn btn-danger btn-sm" disabled>
                <i class="bi bi-trash"></i> Hapus Terpilih (<span id="selected-count">0</span>)
            </button>
        </div>
    </div>
    @endif

    {{-- Daftar Buku --}}
    @forelse ($bukus as $buku)
    <div class="card mb-3 border-start border-3 border-primary shadow-sm">
        <div class="card-body">
            <div class="row align-items-center">
                {{-- Kolom Checkbox Seleksi Massal --}}
                <div class="col-md-1 text-center">
                    <input type="checkbox" name="buku_ids[]" value="{{ $buku->id }}" class="form-check-input buku-checkbox" style="transform: scale(1.4); cursor: pointer;">
                </div>

                <div class="col-md-2 text-center">
                    <i class="bi bi-book text-primary" style="font-size: 3.5rem;"></i>
                    <div class="mt-1">
                        <span class="badge bg-{{ $buku->kategori == 'Programming' ? 'primary' : ($buku->kategori == 'Database' ? 'success' : ($buku->kategori == 'Web Design' ? 'info' : ($buku->kategori == 'Networking' ? 'warning' : 'danger'))) }}">
                            {{ $buku->kategori }}
                        </span>
                    </div>
                </div>

                <div class="col-md-6">
                    <h5 class="card-title mb-1">
                        <a href="{{ route('buku.show', $buku->id) }}" class="text-decoration-none fw-bold">
                            {{ $buku->judul }}
                        </a>
                    </h5>
                    <p class="card-text text-muted small mb-1">
                        <i class="bi bi-person"></i> {{ $buku->pengarang }} |
                        <i class="bi bi-building"></i> {{ $buku->penerbit }} |
                        <i class="bi bi-calendar"></i> {{ $buku->tahun_terbit }} |
                        <i class="bi bi-translate"></i> {{ $buku->bahasa ?? 'Indonesia' }}
                    </p>
                    @if ($buku->isbn)
                    <p class="card-text small text-muted mb-1">
                        <i class="bi bi-upc"></i> ISBN: {{ $buku->isbn }}
                    </p>
                    @endif
                    @if ($buku->deskripsi)
                    <p class="card-text text-secondary small mb-0">
                        {{ Str::limit($buku->deskripsi, 120) }}
                    </p>
                    @endif
                </div>

                <div class="col-md-3 text-end">
                    <h5 class="text-primary fw-bold mb-1">{{ $buku->harga_format }}</h5>
                    <div class="mb-2">
                        @if ($buku->stok > 0)
                        <span class="badge bg-success"><i class="bi bi-check-circle"></i> Tersedia</span>
                        <div class="text-muted small mt-1">Stok: {{ $buku->stok }} buku</div>
                        @else
                        <span class="badge bg-danger"><i class="bi bi-x-circle"></i> Habis</span>
                        @endif
                    </div>

                    <div class="btn-group btn-group-sm" role="group">
                        <a href="{{ route('buku.show', $buku->id) }}" class="btn btn-outline-info"><i class="bi bi-eye"></i> Detail</a>
                        <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-outline-warning"><i class="bi bi-pencil"></i> Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="alert alert-info">
        <i class="bi bi-info-circle"></i> Tidak ada data buku.
    </div>
    @endforelse
</form>

@if ($bukus->count() > 0)
<div class="text-center mt-4">
    <p class="text-muted small">Menampilkan {{ $bukus->count() }} data buku</p>
</div>
@endif

@push('scripts')
<script>
    // Logic Select All Checkbox (Tugas 2)
    const selectAllCheckbox = document.getElementById('select-all');
    const itemCheckboxes = document.querySelectorAll('.buku-checkbox');
    const bulkDeleteButton = document.getElementById('btn-bulk-delete');
    const selectedCountSpan = document.getElementById('selected-count');

    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener('change', function() {
            itemCheckboxes.forEach(cb => {
                cb.checked = this.checked;
            });
            calculateSelection();
        });

        itemCheckboxes.forEach(cb => {
            cb.addEventListener('change', function() {
                const totalChecked = document.querySelectorAll('.buku-checkbox:checked').length;
                selectAllCheckbox.checked = (totalChecked === itemCheckboxes.length);
                calculateSelection();
            });
        });
    }

    function calculateSelection() {
        const checkedCount = document.querySelectorAll('.buku-checkbox:checked').length;
        if (bulkDeleteButton) {
            bulkDeleteButton.disabled = (checkedCount === 0);
            selectedCountSpan.textContent = checkedCount;
        }
    }

    // SweetAlert Konfirmasi Bulk Delete
    if (bulkDeleteButton) {
        bulkDeleteButton.addEventListener('click', function(e) {
            e.preventDefault();
            const selectedTotal = selectedCountSpan.textContent;

            Swal.fire({
                title: 'Hapus Massal?',
                text: `Apakah Anda yakin ingin menghapus sebanyak ${selectedTotal} buku sekaligus? Data tidak dapat dikembalikan!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus Semua!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('bulk-delete-form').submit();
                }
            });
        });
    }
</script>
@endpush
@endsection