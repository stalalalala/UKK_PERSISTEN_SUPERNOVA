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
    // Ganti 'univs' dengan nama tabel yang ada di database Anda
    Schema::table('universitas', function (Blueprint $table) {
        $table->string('lokasi')->nullable()->after('nama_univ');
    });
}

public function down()
{
    Schema::table('universitas', function (Blueprint $table) {
        $table->dropColumn('lokasi');
    });
}
};
