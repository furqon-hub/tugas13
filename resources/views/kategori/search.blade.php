@extends('layouts.app')
@section('title', 'Hasil Pencarian: ' . $keyword)

@section('content')
<h3 class="mb-4">
    Hasil Pencarian untuk: <span class="text-danger">"{{ $keyword }}"</span>
</h3>

@if(count($hasil_pencarian) > 0)
<div class="row">
    @foreach ($hasil_pencarian as $kategori)
    <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm border-primary">
            <div class="card-body">
                <h5 class="card-title">
                    {!! preg_replace("/($keyword)/i", "<mark>$1</mark>", $kategori['nama']) !!}
                </h5>
                <p class="card-text">
                    {!! preg_replace("/($keyword)/i", "<mark>$1</mark>", $kategori['deskripsi']) !!}
                </p>
                <p class="fw-bold mb-0">Total Buku: <span class="badge bg-secondary">{{ $kategori['jumlah_buku'] }}</span></p>
            </div>
            <div class="card-footer bg-white border-0">
                <a href="{{ route('kategori.show', $kategori['id']) }}" class="btn btn-outline-primary w-100">Detail</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@else
<div class="alert alert-warning">
    Tidak menemukan kategori yang mengandung kata kunci <strong>{{ $keyword }}</strong>.
</div>
@endif

<a href="{{ route('kategori.index') }}" class="btn btn-secondary mt-3">&laquo; Kembali ke Daftar Kategori</a>
@endsection