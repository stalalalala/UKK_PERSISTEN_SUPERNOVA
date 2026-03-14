<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kuis_questions', function (Blueprint $table) {
            // Kita ubah dari string(225) ke longText agar muat data foto yang besar
            $table->longText('gambar')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('kuis_questions', function (Blueprint $table) {
            // Balikin ke string kalau di-rollback
            $table->string('gambar', 225)->nullable()->change();
        });
    }
};