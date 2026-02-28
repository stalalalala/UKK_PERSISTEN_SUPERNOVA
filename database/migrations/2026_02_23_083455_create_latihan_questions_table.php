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
        Schema::create('latihan_questions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('latihan_id')->constrained('latihans')->onDelete('cascade');
        
        // Materi dipindah ke sini agar tiap soal bisa punya materi sendiri
        $table->text('materi')->nullable(); 

        $table->text('pertanyaan');
        $table->text('opsi_a');
        $table->text('opsi_b');
        $table->text('opsi_c');
        $table->text('opsi_d');
        $table->text('opsi_e');
        $table->string('jawaban_benar', 1);
        $table->text('pembahasan'); // Wajib ada
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('latihan_questions');
    }
};
