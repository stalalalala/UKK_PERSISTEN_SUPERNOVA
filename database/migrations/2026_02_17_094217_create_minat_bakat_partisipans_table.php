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
    Schema::create('minatbakat_partisipan', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('tgl'); 
        $table->string('hasil'); 
        $table->string('skor'); 
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('minatbakat_partisipan');
}
};
