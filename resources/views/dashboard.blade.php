@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<h1 class="mb-4">
    <i class="bi bi-speedometer2"></i> Dashboard
</h1>

{{-- Statistik Cards --}}
<div class="row mb-4">
    {{-- Total Buku --}}
    <div class="col-md-2 mb-3">
        <div class="card border-primary shadow-sm">
            <div class="card-body text-center">
                <i class="bi bi-book-fill text-primary" style="font-size: 2rem;"></i>
                <h3 class="mt-2">{{ $totalBuku }}</h3>
                <p class="text-muted mb-0">Total Buku</p>
            </div>
        </div>
    </div>

    {{-- Buku Tersedia --}}
    <div class="col-md-2 mb-3">
        <div class="card border-success shadow-sm">
            <div class="card-body text-center">
                <i class="bi bi-check-circle-fill text-success" style="font-size: 2rem;"></i>
                <h3 class="mt-2">{{ $bukuTersedia }}</h3>
                <p class="text-muted mb-0">Tersedia</p>
            </div>
        </div>
    </div>

    {{-- Buku Habis --}}
    <div class="col-md-2 mb-3">
        <div class="card border-danger shadow-sm">
            <div class="card-body text-center">
                <i class="bi bi-x-circle-fill text-danger" style="font-size: 2rem;"></i>
                <h3 class="mt-2">{{ $bukuHabis }}</h3>
                <p class="text-muted mb-0">Habis</p>
            </div>
        </div>
    </div>

    {{-- Total Anggota --}}
    <div class="col-md-2 mb-3">
        <div class="card border-info shadow-sm">
            <div class="card-body text-center">
                <i class="bi bi-people-fill text-info" style="font-size: 2rem;"></i>
                <h3 class="mt-2">{{ $totalAnggota }}</h3>
                <p class="text-muted mb-0">Total Anggota</p>
            </div>
        </div>
    </div>

    {{-- Anggota Aktif --}}
    <div class="col-md-2 mb-3">
        <div class="card border-warning shadow-sm">
            <div class="card-body text-center">
                <i class="bi bi-person-check-fill text-warning" style="font-size: 2rem;"></i>
                <h3 class="mt-2">{{ $anggotaAktif }}</h3>
                <p class="text-muted mb-0">Aktif</p>
            </div>
        </div>
    </div>

    {{-- Anggota Nonaktif --}}
    <div class="col-md-2 mb-3">
        <div class="card border-secondary shadow-sm">
            <div class="card-body text-center">
                <i class="bi bi-person-x-fill text-secondary" style="font-size: 2rem;"></i>
                <h3 class="mt-2">{{ $anggotaNonaktif }}</h3>
                <p class="text-muted mb-0">Nonaktif</p>
            </div>
        </div>
    </div>
</div>

<hr>

<div class="row">
    {{-- 5 Buku Terbaru --}}
    <div class="col-md-6">
        <h5 class="mb-3">
            <i class="bi bi-fire text-warning"></i> 5 Buku Terbaru
        </h5>
        <div class="row g-3">
            @forelse ($bukuTerbaru as $buku)
            <div class="col-md-6">
                <x-buku-card :buku="$buku" :showActions="true" />
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info">
                    <i class="bi bi-info-circle"></i> Tidak ada data buku
                </div>
            </div>
            @endforelse
        </div>
    </div>

    {{-- 5 Anggota Terbaru --}}
    <div class="col-md-6">
        <h5 class="mb-3">
            <i class="bi bi-fire text-warning"></i> 5 Anggota Terbaru
        </h5>
        <div class="list-group">
            @forelse ($anggotaTerbaru as $anggota)
            <a href="{{ route('anggota.show', $anggota->id) }}" class="list-group-item list-group-item-action">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h6 class="mb-1">{{ $anggota->nama }}</h6>
                        <p class="mb-1 text-muted small">
                            <i class="bi bi-envelope"></i> {{ $anggota->email }}
                        </p>
                        <p class="mb-0 text-muted small">
                            <i class="bi bi-telephone"></i> {{ $anggota->telepon }}
                        </p>
                    </div>
                    <div class="text-end">
                        @if ($anggota->status == 'Aktif')
                        <span class="badge bg-success">
                            <i class="bi bi-check-circle"></i> Aktif
                        </span>
                        @else
                        <span class="badge bg-secondary">
                            <i class="bi bi-x-circle"></i> Nonaktif
                        </span>
                        @endif
                    </div>
                </div>
            </a>
            @empty
            <div class="alert alert-info">
                <i class="bi bi-info-circle"></i> Tidak ada data anggota
            </div>
            @endforelse
        </div>
    </div>
</div>

{{-- Quick Links --}}
<div class="row mt-4">
    <div class="col-12">
        <h5 class="mb-3">
            <i class="bi bi-link-45deg"></i> Quick Links
        </h5>
        <div class="btn-group" role="group">
            <a href="{{ route('buku.index') }}" class="btn btn-outline-primary">
                <i class="bi bi-book"></i> Kelola Buku
            </a>
            <a href="{{ route('buku.create') }}" class="btn btn-outline-success">
                <i class="bi bi-plus-circle"></i> Tambah Buku
            </a>
            <a href="{{ route('anggota.index') }}" class="btn btn-outline-info">
                <i class="bi bi-people"></i> Kelola Anggota
            </a>
            <a href="{{ route('anggota.create') }}" class="btn btn-outline-warning">
                <i class="bi bi-plus-circle"></i> Tambah Anggota
            </a>
        </div>
    </div>
</div>

@endsection