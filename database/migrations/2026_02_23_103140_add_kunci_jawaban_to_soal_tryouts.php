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
    Schema::table('soal_tryouts', function (Blueprint $table) {
        // Menambahkan kolom kunci_jawaban setelah opsi_e
        $table->string('kunci_jawaban')->after('opsi_e')->nullable();
    });
}

public function down(): void
{
    Schema::table('soal_tryouts', function (Blueprint $table) {
        $table->dropColumn('kunci_jawaban');
    });
}
};
