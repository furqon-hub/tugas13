<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PerpustakaanController;
use App\Http\Controllers\BukuController;
use App\Models\Buku;
use App\Models\Anggota;

// ==========================================
// 1. ROUTE DEFAULT & HOME
// ==========================================
Route::get('/', function () {
    return view('welcome'); // Diubah ke welcome agar tidak error. Ganti ke 'home' jika file home.blade.php sudah dibuat
})->name('home');

Route::get('/hello', function () {
    return 'Hello dari Laravel!';
});

Route::get('/test-db', function () {
    try {
        DB::connection()->getPdo();
        $dbName = DB::connection()->getDatabaseName();
        return "Koneksi database berhasil!<br />Database: <strong>{$dbName}</strong>";
    } catch (\Exception $e) {
        return "Koneksi database gagal!<br />Error: " . $e->getMessage();
    }
});


// ==========================================
// 2. ROUTE PERPUSTAKAAN (CONTROLLER)
// ==========================================
Route::get('/perpustakaan', [PerpustakaanController::class, 'index'])->name('perpus.home');
Route::get('/about', [PerpustakaanController::class, 'about']);
// Route::get('/buku/{id}', [PerpustakaanController::class, 'show']); // Dimatikan karena bentrok dengan BukuController Resource


// ==========================================
// 3. ROUTE KATEGORI (TUGAS 9)
// ==========================================
Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
Route::get('/kategori/search/{keyword}', [KategoriController::class, 'search'])->name('kategori.search');
Route::get('/kategori/{id}', [KategoriController::class, 'show'])->name('kategori.show');


// ==========================================
// 4. ROUTE BUKU (PRAKTIKUM 11 - RESOURCE)
// ==========================================
// Resource route akan otomatis membuatkan route index, create, store, show, edit, update, destroy
Route::resource('buku', BukuController::class);

// Custom route untuk filter kategori
Route::get('/buku/kategori/{kategori}', [BukuController::class, 'filterKategori'])->name('buku.kategori');


// ==========================================
// 5. ROUTE ANGGOTA (DARI DATABASE)
// ==========================================
Route::get('/anggota', function () {
    $anggotas = Anggota::all();

    $html = '<h1>Daftar Anggota</h1>';
    $html .= '<table border="1" cellpadding="10">';
    $html .= '<tr><th>ID</th><th>Kode</th><th>Nama</th><th>Email</th><th>Umur</th><th>Status</th><th>Aksi</th></tr>';

    foreach ($anggotas as $anggota) {
        $html .= '<tr>';
        $html .= '<td>' . $anggota->id . '</td>';
        $html .= '<td>' . $anggota->kode_anggota . '</td>';
        $html .= '<td>' . $anggota->nama . '</td>';
        $html .= '<td>' . $anggota->email . '</td>';
        $html .= '<td>' . $anggota->umur . ' tahun</td>';
        $html .= '<td>' . $anggota->status . '</td>';
        $html .= '<td><a href="/anggota/' . $anggota->id . '">Detail</a></td>';
        $html .= '</tr>';
    }
    $html .= '</table>';
    return $html;
})->name('anggota.index');

Route::get('/anggota/{id}', function ($id) {
    $anggota = Anggota::findOrFail($id);

    $html = '<h1>Detail Anggota</h1>';
    $html .= '<a href="/anggota">Kembali</a><br /><br />';
    $html .= '<table border="1" cellpadding="10">';
    $html .= '<tr><th>Field</th><th>Value</th></tr>';
    $html .= '<tr><td>Kode Anggota</td><td>' . $anggota->kode_anggota . '</td></tr>';
    $html .= '<tr><td>Nama</td><td>' . $anggota->nama . '</td></tr>';
    $html .= '<tr><td>Email</td><td>' . $anggota->email . '</td></tr>';
    $html .= '<tr><td>Telepon</td><td>' . $anggota->telepon . '</td></tr>';
    $html .= '<tr><td>Alamat</td><td>' . $anggota->alamat . '</td></tr>';
    $html .= '<tr><td>Tanggal Lahir</td><td>' . $anggota->tanggal_lahir->format('d-m-Y') . '</td></tr>';
    $html .= '<tr><td>Umur</td><td>' . $anggota->umur . ' tahun</td></tr>';
    $html .= '<tr><td>Jenis Kelamin</td><td>' . $anggota->jenis_kelamin . '</td></tr>';
    $html .= '<tr><td>Pekerjaan</td><td>' . $anggota->pekerjaan . '</td></tr>';
    $html .= '<tr><td>Tanggal Daftar</td><td>' . $anggota->tanggal_daftar->format('d-m-Y') . '</td></tr>';
    $html .= '<tr><td>Lama Anggota</td><td>' . $anggota->lama_anggota . ' hari</td></tr>';
    $html .= '<tr><td>Status</td><td>' . $anggota->status . '</td></tr>';
    $html .= '</table>';
    return $html;
})->name('anggota.show');


// ==========================================
// 6. ROUTE TESTING ELOQUENT & SCOPE (TUGAS 10)
// ==========================================
Route::get('/test-query', function () {
    $html = '<h1>Testing Query Eloquent</h1>';

    $tersedia = Buku::tersedia()->get();
    $html .= '<h3>Buku Tersedia (Stok > 0): ' . $tersedia->count() . '</h3><ul>';
    foreach ($tersedia as $buku) {
        $html .= '<li>' . $buku->judul . ' (Stok: ' . $buku->stok . ')</li>';
    }
    $html .= '</ul>';

    $programming = Buku::kategori('Programming')->get();
    $html .= '<h3>Buku Programming: ' . $programming->count() . '</h3><ul>';
    foreach ($programming as $buku) {
        $html .= '<li>' . $buku->judul . '</li>';
    }
    $html .= '</ul>';

    $aktif = Anggota::aktif()->get();
    $html .= '<h3>Anggota Aktif: ' . $aktif->count() . '</h3><ul>';
    foreach ($aktif as $anggota) {
        $html .= '<li>' . $anggota->nama . ' (' . $anggota->email . ')</li>';
    }
    $html .= '</ul>';

    return $html;
});

Route::get('/test-accessor-scope', function () {
    $html = '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">';
    $html .= '<div class="container mt-5">';
    $html .= '<h1>Testing Accessor & Scope</h1><hr>';

    $html .= '<h3>A. Buku dengan status_stok_badge & tahun_label</h3><ul>';
    $bukus = Buku::limit(5)->get();
    foreach ($bukus as $buku) {
        $html .= "<li>{$buku->judul} | Stok: {$buku->status_stok_badge} | Kategori: <strong>{$buku->tahun_label}</strong></li>";
    }
    $html .= '</ul>';

    $html .= '<h3>B. Buku Terbaru (Scope: terbaru)</h3><ul>';
    $bukuTerbaru = Buku::terbaru()->get();
    foreach ($bukuTerbaru as $buku) {
        $html .= "<li>{$buku->judul} (Tahun: {$buku->tahun_terbit})</li>";
    }
    $html .= '</ul>';

    $html .= '<h3>C. Buku Stok Menipis (Scope: stokMenipis)</h3><ul>';
    $bukuMenipis = Buku::stokMenipis()->get();
    foreach ($bukuMenipis as $buku) {
        $html .= "<li>{$buku->judul} - Sisa Stok: {$buku->stok}</li>";
    }
    $html .= '</ul><hr>';

    $html .= '<h3>D. Anggota dengan status_badge & kategori_usia</h3><ul>';
    $anggotas = Anggota::limit(5)->get();
    foreach ($anggotas as $anggota) {
        $html .= "<li>{$anggota->nama} | Status: {$anggota->status_badge} | Kategori Usia: <strong>{$anggota->kategori_usia}</strong></li>";
    }
    $html .= '</ul>';

    $html .= '<h3>E. Anggota Terdaftar Bulan Ini (Scope: terdaftarBulanIni)</h3><ul>';
    $anggotaBaru = Anggota::terdaftarBulanIni()->get();
    foreach ($anggotaBaru as $anggota) {
        $html .= "<li>{$anggota->nama} - Tgl Daftar: {$anggota->created_at->format('d M Y')}</li>";
    }
    $html .= '</ul></div>';

    return $html;
});
