<div class="card h-100 shadow-sm border-0 hover-shadow">
    {{-- Card Header dengan Icon --}}
    <div class="card-body">
        <div class="d-flex align-items-start mb-3">
            {{-- Icon Buku --}}
            <div class="me-3">
                <i class="bi bi-book text-primary" style="font-size: 2.5rem;"></i>
            </div>

            {{-- Badge Kategori --}}
            <div>
                <span class="badge bg-{{ $buku->kategori == 'Programming' ? 'primary' : ($buku->kategori == 'Database' ? 'success' : ($buku->kategori == 'Web Design' ? 'info' : ($buku->kategori == 'Networking' ? 'warning' : 'danger'))) }}">
                    {{ $buku->kategori }}
                </span>
            </div>
        </div>

        {{-- Judul Buku --}}
        <h5 class="card-title fw-bold mb-2">
            <a href="{{ route('buku.show', $buku->id) }}" class="text-decoration-none text-dark">
                {{ Str::limit($buku->judul, 50) }}
            </a>
        </h5>

        {{-- Pengarang --}}
        <p class="card-text text-muted mb-2">
            <i class="bi bi-person-circle"></i>
            <small>{{ Str::limit($buku->pengarang, 40) }}</small>
        </p>

        {{-- Penerbit & Tahun --}}
        <p class="card-text text-muted mb-3">
            <i class="bi bi-building"></i>
            <small>{{ $buku->penerbit }} ({{ $buku->tahun_terbit }})</small>
        </p>

        {{-- Harga --}}
        <h6 class="text-primary fw-bold mb-2">
            {{ $buku->harga_format }}
        </h6>

        {{-- Status Stok --}}
        <div class="mb-3">
            @if ($buku->stok > 0)
            <span class="badge bg-success">
                <i class="bi bi-check-circle"></i> Stok: {{ $buku->stok }}
            </span>
            @else
            <span class="badge bg-danger">
                <i class="bi bi-x-circle"></i> Habis
            </span>
            @endif
        </div>

        {{-- Action Buttons --}}
        @if ($showActions)
        <div class="d-grid gap-2">
            <a href="{{ route('buku.show', $buku->id) }}" class="btn btn-sm btn-outline-primary">
                <i class="bi bi-eye"></i> Detail
            </a>
            <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-sm btn-outline-warning">
                <i class="bi bi-pencil"></i> Edit
            </a>
        </div>
        @endif
    </div>
</div>

<style>
    .hover-shadow {
        transition: box-shadow 0.3s ease;
    }

    .hover-shadow:hover {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }
</style>