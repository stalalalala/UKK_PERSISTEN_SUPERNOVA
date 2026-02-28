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
    Schema::create('jawaban_users', function (Blueprint $table) {
        $table->id();
        // Menghubungkan ke tabel users
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        // Menghubungkan ke tabel soal_tryouts
        $table->foreignId('soal_id')->constrained('soal_tryouts')->onDelete('cascade');
        // Pilihan jawaban (A, B, C, D, E)
        $table->string('pilihan_user', 5)->nullable();
        // Status benar atau salah
        $table->boolean('is_correct')->default(false);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jawaban_users');
    }
};
