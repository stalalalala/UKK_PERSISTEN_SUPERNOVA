<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('kuis_questions', function (Blueprint $table) {
            $table->dropColumn('subtes');
        });
    }

    public function down()
    {
        Schema::table('kuis_questions', function (Blueprint $table) {
            $table->string('subtes')->nullable();
        });
    }
};