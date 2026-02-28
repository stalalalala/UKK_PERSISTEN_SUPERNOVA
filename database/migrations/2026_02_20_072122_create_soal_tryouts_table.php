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
    Schema::create('soal_tryouts', function (Blueprint $table) {
        $table->id();
        $table->foreignId('category_id')->constrained('tryout_categories')->onDelete('cascade');
        
        $table->text('materi_teks')->nullable();

        $table->text('pertanyaan');
        $table->text('opsi_a');
        $table->text('opsi_b');
        $table->text('opsi_c');
        $table->text('opsi_d');
        $table->text('opsi_e');
        $table->char('jawaban_benar', 1); 

        $table->text('pembahasan')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soal_tryouts');
    }
};
