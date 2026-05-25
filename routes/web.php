<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PerpustakaanController;


// Route default
Route::get('/', function () {
    return view('welcome');
});

// Route baru - return text
Route::get('/hello', function () {
    return 'Hello dari Laravel!';
});

// Route dengan HTML
Route::get('/info', function () {
    return '<h1>Sistem Perpustakaan</h1><p>Selamat datang!</p>';
});

// Route dengan JSON
Route::get('/buku', function () {
    return [
        'judul' => 'Laravel Programming',
        'pengarang' => 'John Doe',
        'harga' => 150000
    ];
});

// Route dengan parameter required
Route::get('/buku/{id}', function ($id) {
    return "Detail buku dengan ID: " . $id;
});

// Route dengan parameter optional
// Route::get('/kategori/{nama?}', function ($nama = 'Semua Kategori') {
//     return "Menampilkan kategori: " . $nama;
// });

// Route dengan multiple parameters
Route::get('/search/{kategori}/{keyword}', function ($kategori, $keyword) {
    return "Cari buku kategori: $kategori dengan keyword: $keyword";
});

// Named route
Route::get('/perpustakaan', function () {
    return 'Halaman Perpustakaan';
})->name('perpus.home');

// Gunakan named route
Route::get('/test-route', function () {
    $url = route('perpus.home');
    return "URL perpustakaan: " . $url;
});

Route::get('/perpustakaan', function () {
    // Data untuk dikirim ke view
    $nama_sistem = "Sistem Perpustakaan Laravel";
    $versi = "12.x";
    $total_buku = 5;

    $buku_list = [
        [
            'judul' => 'Pemrograman PHP',
            'pengarang' => 'Budi Raharjo',
            'harga' => 75000,
            'stok' => 10
        ],
        [
            'judul' => 'Laravel Framework',
            'pengarang' => 'Andi Nugroho',
            'harga' => 125000,
            'stok' => 5
        ],
        [
            'judul' => 'MySQL Database',
            'pengarang' => 'Siti Aminah',
            'harga' => 95000,
            'stok' => 0
        ],
        [
            'judul' => 'Web Design',
            'pengarang' => 'Dedi Santoso',
            'harga' => 85000,
            'stok' => 8
        ],
        [
            'judul' => 'JavaScript Modern',
            'pengarang' => 'Rina Wijaya',
            'harga' => 80000,
            'stok' => 12
        ]
    ];

    // Return view dengan data
    return view('perpustakaan.index', [
        'nama_sistem' => $nama_sistem,
        'versi' => $versi,
        'total_buku' => $total_buku,
        'buku_list' => $buku_list
    ]);
});

Route::get('/', function () {
    return view('welcome');
});

// Route menggunakan Controller
Route::get('/perpustakaan', [PerpustakaanController::class, 'index']);
Route::get('/buku/{id}', [PerpustakaanController::class, 'show']);
Route::get('/about', [PerpustakaanController::class, 'about']);


// Data dummy untuk Anggota (Diletakkan di variabel global file web.php untuk simulasi)
$anggota_list = [
    ['id' => 1, 'kode' => 'AGT-001', 'nama' => 'Budi Santoso', 'email' => 'budi@email.com', 'telepon' => '081234567890', 'alamat' => 'Jakarta', 'status' => 'Aktif'],
    ['id' => 2, 'kode' => 'AGT-002', 'nama' => 'Siti Aminah', 'email' => 'siti@email.com', 'telepon' => '081234567891', 'alamat' => 'Bandung', 'status' => 'Aktif'],
    ['id' => 3, 'kode' => 'AGT-003', 'nama' => 'Agus Hariyanto', 'email' => 'agus@email.com', 'telepon' => '081234567892', 'alamat' => 'Semarang', 'status' => 'Nonaktif'],
    ['id' => 4, 'kode' => 'AGT-004', 'nama' => 'Dewi Lestari', 'email' => 'dewi@email.com', 'telepon' => '081234567893', 'alamat' => 'Surabaya', 'status' => 'Aktif'],
    ['id' => 5, 'kode' => 'AGT-005', 'nama' => 'Eko Prasetyo', 'email' => 'eko@email.com', 'telepon' => '081234567894', 'alamat' => 'Yogyakarta', 'status' => 'Nonaktif'],
];

// --- ROUTING ANGGOTA (TUGAS 1) ---
Route::get('/anggota', function () use ($anggota_list) {
    return view('anggota.index', compact('anggota_list'));
})->name('anggota.index');

Route::get('/anggota/{id}', function ($id) use ($anggota_list) {
    // Cari anggota berdasarkan ID
    $anggota = collect($anggota_list)->firstWhere('id', $id);
    if (!$anggota) {
        abort(404);
    }
    return view('anggota.show', compact('anggota'));
})->name('anggota.show');

// --- ROUTING KATEGORI (TUGAS 2) ---
Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
Route::get('/kategori/search/{keyword}', [KategoriController::class, 'search'])->name('kategori.search');
Route::get('/kategori/{id}', [KategoriController::class, 'show'])->name('kategori.show');
