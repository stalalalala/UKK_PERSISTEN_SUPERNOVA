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
    Schema::table('latihan_questions', function (Blueprint $table) {
         $table->longText('gambar')->nullable()->after('materi');
    });
}

public function down()
{
    Schema::table('latihan_questions', function (Blueprint $table) {
        $table->dropColumn('gambar');
    });
}
};
