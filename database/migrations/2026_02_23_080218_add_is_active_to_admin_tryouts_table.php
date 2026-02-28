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
        Schema::table('admin_tryouts', function (Blueprint $column) {
            // Menambahkan kolom is_active dengan tipe boolean
            // Default 1 artinya aktif saat tryout pertama kali dibuat
            $column->boolean('is_active')->default(1)->after('tanggal_akhir');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admin_tryouts', function (Blueprint $column) {
            // Menghapus kolom jika migration di-rollback
            $column->dropColumn('is_active');
        });
    }
};