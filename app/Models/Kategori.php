<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    // Mendefinisikan nama tabel secara eksplisit agar tidak plural ('kategoris')
    protected $table = 'kategori';

    protected $fillable = [
        'nama_kategori',
        'deskripsi',
        'icon',
        'warna'
    ];
}
