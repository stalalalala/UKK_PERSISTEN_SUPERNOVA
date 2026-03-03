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
        Schema::table('streaks', function (Blueprint $table) {
            $table->integer('miss_count')->default(0);
            $table->integer('recovery_used')->default(0);
            $table->string('recovery_month')->nullable();
            $table->dateTime('last_active_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('streaks', function (Blueprint $table) {
            $table->dropColumn([
                'miss_count',
                'recovery_used',
                'recovery_month',
                'last_active_at'
            ]);
        });
    }
};
