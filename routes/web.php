<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PerpustakaanController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\DashboardController;
use App\Models\Buku;
use App\Models\Anggota;

// ==========================================
// 1. ROUTE DEFAULT & HOME
// ==========================================
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

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


// ==========================================
// 3. ROUTE KATEGORI (TUGAS 9)
// ==========================================
Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
Route::get('/kategori/search/{keyword}', [KategoriController::class, 'search'])->name('kategori.search');
Route::get('/kategori/{id}', [KategoriController::class, 'show'])->name('kategori.show');


// ==========================================
// 4. ROUTE BUKU (PRAKTIKUM 11 - RESOURCE)
// ==========================================
Route::get('/buku/kategori/{kategori}', [BukuController::class, 'filterKategori'])->name('buku.kategori');
Route::post('/buku/search', [BukuController::class, 'search'])->name('buku.search');
Route::get('/buku/search', [BukuController::class, 'search'])->name('buku.search');

// Route untuk fitur Pertemuan 12
Route::post('/buku/bulk-delete', [BukuController::class, 'bulkDelete'])->name('buku.bulk-delete');
Route::get('/buku/export', [BukuController::class, 'export'])->name('buku.export');

// Resource route buku
Route::resource('buku', BukuController::class);


// ==========================================
// 5. ROUTE ANGGOTA (TUGAS PERTEMUAN 13)
// ==========================================
Route::get('/anggota/export', [AnggotaController::class, 'export'])->name('anggota.export');
Route::get('/anggota/search', [AnggotaController::class, 'search'])->name('anggota.search');
Route::resource('anggota', AnggotaController::class);


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
