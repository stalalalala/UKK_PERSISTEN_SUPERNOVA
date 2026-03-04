<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('universitas', function (Blueprint $table) {
            // Tambahkan kolom is_deleted dengan default 0 (false)
            $table->boolean('is_deleted')->default(false)->after('lokasi'); 
        });
    }

    public function down(): void
    {
        Schema::table('universitas', function (Blueprint $table) {
            $table->dropColumn('is_deleted');
        });
    }
};