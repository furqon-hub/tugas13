<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Anggota extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan oleh model ini.
     *
     * @var string
     */
    protected $table = 'anggota';

    /**
     * Kolom yang dapat diisi secara mass assignment.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kode_anggota',
        'nama',
        'email',
        'telepon',
        'alamat',
        'tanggal_lahir',
        'jenis_kelamin',
        'pekerjaan',
        'tanggal_daftar',
        'status',
    ];

    /**
     * Tipe casting untuk atribut.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_daftar' => 'date',
    ];

    /**
     * Accessor untuk menghitung umur.
     */
    public function getUmurAttribute(): int
    {
        return Carbon::parse($this->tanggal_lahir)->age;
    }

    /**
     * Accessor untuk lama menjadi anggota (dalam hari).
     */
    public function getLamaAnggotaAttribute(): int
    {
        return Carbon::parse($this->tanggal_daftar)->diffInDays(now());
    }

    /**
     * Scope untuk filter anggota aktif.
     */
    public function scopeAktif($query)
    {
        return $query->where('status', 'Aktif');
    }

    // ==========================================
    // KODE TAMBAHAN UNTUK TUGAS 10
    // ==========================================

    /**
     * Accessor: status_badge
     * Return HTML badge berdasarkan status
     */
    public function getStatusBadgeAttribute(): string
    {
        if (strtolower($this->status) === 'aktif') {
            return '<span class="badge bg-success">Aktif</span>';
        }
        return '<span class="badge bg-secondary">Nonaktif</span>';
    }

    /**
     * Accessor: kategori_usia
     * Return string kategori berdasarkan umur
     */
    public function getKategoriUsiaAttribute(): string
    {
        // Menggunakan accessor umur yang sudah kamu buat di atas
        $umur = $this->umur;

        if ($umur < 20) {
            return 'Remaja';
        } elseif ($umur >= 20 && $umur <= 50) {
            return 'Dewasa';
        } else {
            return 'Senior';
        }
    }

    /**
     * Scope: jenisKelamin
     * Filter berdasarkan jenis kelamin
     */
    public function scopeJenisKelamin($query, $jk)
    {
        return $query->where('jenis_kelamin', $jk);
    }

    /**
     * Scope: terdaftarBulanIni
     * Filter anggota yang terdaftar di bulan ini
     */
    public function scopeTerdaftarBulanIni($query)
    {
        // Menggunakan field 'created_at' (bawaan timestamp Laravel)
        return $query->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year);
    }
}
