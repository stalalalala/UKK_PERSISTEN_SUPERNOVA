<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('kuis_questions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('kuis_id')
                ->constrained('kuis')
                ->onDelete('cascade');

            $table->text('pertanyaan');

            $table->text('opsi_a');
            $table->text('opsi_b');
            $table->text('opsi_c');
            $table->text('opsi_d');
            $table->text('opsi_e');

            $table->string('jawaban_benar', 1);

            $table->integer('bobot')->default(1);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kuis_questions');
    }
};
