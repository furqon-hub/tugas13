@extends('layouts.app')
@section('title', 'Kategori Buku')

@section('content')
<h3 class="mb-4">Daftar Kategori Buku</h3>
<div class="row">
    @foreach ($kategori_list as $kategori)
    <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm border-0">
            <div class="card-body">
                <h5 class="card-title text-primary">{{ $kategori['nama'] }}</h5>
                <p class="card-text text-muted">{{ $kategori['deskripsi'] }}</p>
                <p class="fw-bold mb-0">Total Buku: <span class="badge bg-secondary">{{ $kategori['jumlah_buku'] }}</span></p>
            </div>
            <div class="card-footer bg-white border-0">
                <a href="{{ route('kategori.show', $kategori['id']) }}" class="btn btn-primary w-100">Lihat Detail Kategori</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection