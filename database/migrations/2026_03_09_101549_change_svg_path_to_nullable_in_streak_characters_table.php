<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('streak_characters', function (Blueprint $table) {
            // Mengubah kolom yang sudah ada menjadi nullable
            $table->string('svg_path')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('streak_characters', function (Blueprint $table) {
            // Mengembalikan jika ingin dibatalkan (rollback)
            $table->string('svg_path')->nullable(false)->change();
        });
    }
};
