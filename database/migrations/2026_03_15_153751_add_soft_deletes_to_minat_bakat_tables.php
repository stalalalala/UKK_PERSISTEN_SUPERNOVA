<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Menambahkan soft deletes ke tabel kategori
        Schema::table('minatbakat_kategori', function (Blueprint $table) {
            $table->softDeletes(); 
        });

        // Menambahkan soft deletes ke tabel soal
        Schema::table('minat_bakat_soals', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::table('minatbakat_kategori', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('minat_bakat_soals', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};