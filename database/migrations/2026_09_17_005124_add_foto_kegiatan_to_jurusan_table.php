<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jurusan', function (Blueprint $table) {
            $table->string('foto_kegiatan')->nullable()->after('logo');
        });
    }

    public function down(): void
    {
        Schema::table('jurusan', function (Blueprint $table) {
            $table->dropColumn('foto_kegiatan');
        });
    }
};