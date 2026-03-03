<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_target_tryouts', function (Blueprint $table) {
            $table->id();
            // Menghubungkan ke tabel users (peserta)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // Menghubungkan ke tabel prodis (pilihan jurusan/prodi)
            $table->foreignId('prodi_id')->constrained('prodis')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_target_tryouts');
    }
};