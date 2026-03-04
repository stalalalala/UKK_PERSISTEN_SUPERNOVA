<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('prodis', function (Blueprint $col) {
            // Tambahkan kolom is_deleted dengan default false (0)
            $col->boolean('is_deleted')->default(false)->after('peminat');
        });
    }

    public function down(): void
    {
        Schema::table('prodis', function (Blueprint $col) {
            $col->dropColumn('is_deleted');
        });
    }
};