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
    Schema::table('tryout_categories', function (Blueprint $table) {
        $table->softDeletes(); // Ini akan menambah kolom deleted_at
    });

    Schema::table('soal_tryouts', function (Blueprint $table) {
        $table->softDeletes();
    });
}

public function down(): void
{
    Schema::table('tryout_categories', function (Blueprint $table) {
        $table->dropSoftDeletes();
    });

    Schema::table('soal_tryouts', function (Blueprint $table) {
        $table->dropSoftDeletes();
    });
}
};
