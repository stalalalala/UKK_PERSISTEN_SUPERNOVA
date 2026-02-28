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
        Schema::create('tryout_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_tryout_id')->constrained('admin_tryouts')->onDelete('cascade');
            $table->string('nama_kategori');
            $table->integer('durasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tryout_categories');
    }
};
