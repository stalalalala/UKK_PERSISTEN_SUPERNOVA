<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->unsignedInteger('total_xp')->default(0)->after('password');

            $table->unsignedInteger('level')->default(0)->after('total_xp');

            $table->unsignedInteger('streak_days')->default(0)->after('level');

            $table->date('last_xp_date')->nullable()->after('streak_days');

            $table->boolean('streak_active')->default(true)->after('last_xp_date');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'total_xp',
                'level',
                'streak_days',
                'last_xp_date',
                'streak_active'
            ]);
        });
    }
};
