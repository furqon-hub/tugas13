<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Jika nama tabelnya default 'kategoris', kamu bisa ubah menjadi 'kategori'
        Schema::create('kategori', function (Blueprint $table) {
            $table->id(); // bigint, primary key, auto increment
            $table->string('nama_kategori', 50)->unique();
            $table->text('deskripsi')->nullable();
            $table->string('icon', 50)->nullable();
            $table->string('warna', 20)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kategori');
    }
};
