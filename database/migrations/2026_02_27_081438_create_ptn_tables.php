<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('universitas', function (Blueprint $table) {
        $table->id();
        $table->string('nama_univ');
        $table->timestamps();
    });

    Schema::create('prodis', function (Blueprint $table) {
        $table->id();
        $table->foreignId('universitas_id')->constrained('universitas')->onDelete('cascade');
        $table->string('nama_prodi');
        $table->integer('kuota');
        $table->integer('peminat');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ptn_tables');
    }
};
