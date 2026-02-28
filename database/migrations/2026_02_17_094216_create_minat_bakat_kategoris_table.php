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
    Schema::create('minatbakat_kategori', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->integer('soal')->default(0);
        $table->string('color')->default('#4A72D4');
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('minatbakat_kategori');
}
};
