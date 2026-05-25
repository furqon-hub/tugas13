@extends('layouts.app')
@section('title', 'Detail Anggota')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Detail Anggota</h4>
                <span class="badge {{ $anggota['status'] == 'Aktif' ? 'bg-success' : 'bg-danger' }}">
                    Status: {{ $anggota['status'] }}
                </span>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="30%">Kode Anggota</th>
                        <td>: {{ $anggota['kode'] }}</td>
                    </tr>
                    <tr>
                        <th>Nama Lengkap</th>
                        <td>: {{ $anggota['nama'] }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>: {{ $anggota['email'] }}</td>
                    </tr>
                    <tr>
                        <th>Telepon</th>
                        <td>: {{ $anggota['telepon'] }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>: {{ $anggota['alamat'] }}</td>
                    </tr>
                </table>
            </div>
            <div class="card-footer bg-white">
                <a href="{{ route('anggota.index') }}" class="btn btn-secondary">&laquo; Kembali ke Daftar</a>
            </div>
        </div>
    </div>
</div>
@endsection