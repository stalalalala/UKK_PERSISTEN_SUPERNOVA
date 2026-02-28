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
        Schema::create('streaks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('total_xp')->default(0);
            $table->integer('jumlah_hari')->default(0);
            $table->integer('level')->default(1);
            $table->date('last_claim')->nullable();
            $table->date('last_recovery')->nullable();
            $table->timestamps();
        });
    }

    /**`
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('streaks');
    }
};
