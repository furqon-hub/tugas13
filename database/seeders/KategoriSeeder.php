<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama_kategori' => 'Programming', 'icon' => 'code-slash', 'warna' => 'primary'],
            ['nama_kategori' => 'Database', 'icon' => 'database', 'warna' => 'success'],
            ['nama_kategori' => 'Web Design', 'icon' => 'palette', 'warna' => 'info'],
            ['nama_kategori' => 'Networking', 'icon' => 'wifi', 'warna' => 'warning'],
            ['nama_kategori' => 'Data Science', 'icon' => 'graph-up', 'warna' => 'danger'],
        ];

        foreach ($data as $item) {
            Kategori::create($item);
        }
    }
}
