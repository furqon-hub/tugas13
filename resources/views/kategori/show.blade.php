@extends('layouts.app')
@section('title', 'Detail Kategori: ' . $kategori['nama'])

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('kategori.index') }}">Kategori</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $kategori['nama'] }}</li>
    </ol>
</nav>

<div class="card shadow-sm mb-4">
    <div class="card-header bg-white">
        <h4 class="mb-0 text-primary">Kategori: {{ $kategori['nama'] }}</h4>
    </div>
    <div class="card-body">
        <p>{{ $kategori['deskripsi'] }}</p>
        <p class="mb-0">Jumlah Total Buku: <strong>{{ $kategori['jumlah_buku'] }}</strong></p>
    </div>
</div>

<h5 class="mb-3">Daftar Buku di Kategori Ini:</h5>
<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Judul Buku</th>
                <th>Penulis</th>
                <th>Tahun Rilis</th>
            </tr>
        </thead>
        <tbody>
            @foreach($buku_list as $index => $buku)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $buku['judul'] }}</td>
                <td>{{ $buku['penulis'] }}</td>
                <td>{{ $buku['tahun'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection