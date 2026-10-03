<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->string('kategori'); // kode jurusan: PPLG, TPFL, TO, TJKT
            $table->string('kategori_produk')->nullable(); // misal: "Aksesoris & Kerajinan"
            $table->string('nama');
            $table->string('slug')->unique();
            $table->text('deskripsi_singkat');
            $table->longText('deskripsi_lengkap');
            $table->string('gambar')->nullable();
            $table->date('tanggal');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};