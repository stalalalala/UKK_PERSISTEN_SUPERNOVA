<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('kuis', function (Blueprint $table) {
            $table->id();

            $table->string('judul');
            $table->string('kategori');

            $table->integer('set_ke')->default(1);
            $table->integer('durasi')->default(20);

            $table->longText('materi')->nullable();
            $table->string('video_url')->nullable();

            $table->boolean('is_active')->default(false);
            $table->boolean('is_published')->default(false);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kuis');
    }
};
