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
        Schema::table('admin_tryouts', function (Blueprint $table) {
            // Menambahkan kolom deleted_at otomatis
            $table->softDeletes(); 
        });
    }

    public function down(): void
    {
        Schema::table('admin_tryouts', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
