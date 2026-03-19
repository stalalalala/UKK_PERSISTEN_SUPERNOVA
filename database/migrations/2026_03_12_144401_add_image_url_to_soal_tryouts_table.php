<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('soal_tryouts', function (Blueprint $blueprint) {
            $blueprint->text('image_url')->nullable()->after('materi_teks');
        });
    }

    public function down(): void
    {
        Schema::table('soal_tryouts', function (Blueprint $blueprint) {
            $blueprint->dropColumn('image_url');
        });
    }
};