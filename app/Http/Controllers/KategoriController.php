<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KategoriController extends Controller
{
    // Mock Data Kategori ditaruh di property class agar bisa diakses semua method
    private $kategori_list = [
        ['id' => 1, 'nama' => 'Programming', 'deskripsi' => 'Buku pemrograman dan coding', 'jumlah_buku' => 25],
        ['id' => 2, 'nama' => 'Design', 'deskripsi' => 'Buku desain grafis dan UI/UX', 'jumlah_buku' => 15],
        ['id' => 3, 'nama' => 'Networking', 'deskripsi' => 'Buku jaringan komputer', 'jumlah_buku' => 10],
        ['id' => 4, 'nama' => 'Database', 'deskripsi' => 'Buku manajemen basis data', 'jumlah_buku' => 12],
        ['id' => 5, 'nama' => 'Soft Skill', 'deskripsi' => 'Buku pengembangan diri', 'jumlah_buku' => 8],
    ];

    public function index()
    {
        $kategori_list = $this->kategori_list;
        return view('kategori.index', compact('kategori_list'));
    }

    public function show($id)
    {
        // Cari Kategori
        $kategori = collect($this->kategori_list)->firstWhere('id', $id);

        if (!$kategori) {
            abort(404);
        }

        // Mock data buku khusus untuk kategori ini
        $buku_list = [
            ['id' => 101, 'judul' => 'Belajar Laravel 10', 'penulis' => 'Taylor Otwell', 'tahun' => 2023],
            ['id' => 102, 'judul' => 'Mastering React', 'penulis' => 'Dan Abramov', 'tahun' => 2022],
            ['id' => 103, 'judul' => 'Clean Code', 'penulis' => 'Robert C. Martin', 'tahun' => 2008],
        ];

        return view('kategori.show', compact('kategori', 'buku_list'));
    }

    public function search($keyword)
    {
        // Filter array case-insensitive menggunakan stripos
        $hasil_pencarian = array_filter($this->kategori_list, function ($item) use ($keyword) {
            return stripos($item['nama'], $keyword) !== false || stripos($item['deskripsi'], $keyword) !== false;
        });

        return view('kategori.search', compact('hasil_pencarian', 'keyword'));
    }
}
