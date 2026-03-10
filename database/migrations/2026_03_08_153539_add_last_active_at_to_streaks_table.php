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
    Schema::table('streaks', function (Blueprint $table) {
        $table->timestamp('last_active_at')->nullable()->after('level');
    });
}

public function down()
{
    Schema::table('streaks', function (Blueprint $table) {
        $table->dropColumn('last_active_at');
    });
}
};
