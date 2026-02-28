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
    Schema::rename('jawaban_users', 'tryout_jawaban_peserta');
}

public function down(): void
{
    Schema::rename('tryout_jawaban_peserta', 'jawaban_users');
}
};
