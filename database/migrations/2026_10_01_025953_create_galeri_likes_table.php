<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('galeri_likes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('galeri_id')->index();
            $table->string('visitor_token', 64);
            $table->timestamps();

            $table->unique(['galeri_id', 'visitor_token']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('galeri_likes');
    }
};