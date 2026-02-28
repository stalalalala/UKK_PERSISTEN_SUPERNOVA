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
        Schema::create('latihans', function (Blueprint $table) {
        $table->id();
        $table->string('set_ke'); // Contoh: Set 1
        $table->string('subtes');   // PK, PM, dll
        $table->integer('durasi');  // Menit
        
        $table->boolean('is_active')->default(false);
        $table->boolean('is_published')->default(false);

        $table->softDeletes();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('latihans');
    }
};
