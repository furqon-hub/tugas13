@extends('layouts.app')
@section('title', 'Daftar Anggota')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white">
        <h3 class="mb-0">Daftar Anggota Perpustakaan</h3>
    </div>
    <div class="card-body">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Kode Anggota</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($anggota_list as $index => $anggota)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $anggota['kode'] }}</td>
                    <td>{{ $anggota['nama'] }}</td>
                    <td>{{ $anggota['email'] }}</td>
                    <td>
                        <span class="badge {{ $anggota['status'] == 'Aktif' ? 'bg-success' : 'bg-danger' }}">
                            {{ $anggota['status'] }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('anggota.show', $anggota['id']) }}" class="btn btn-sm btn-info text-white">Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection