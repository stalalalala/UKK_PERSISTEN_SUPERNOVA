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
        Schema::create('admin_videos', function (Blueprint $table) {
            $table->id(); // ✅ AUTO INCREMENT (PRIMARY KEY)
            $table->string('subtes');
            $table->string('judul_video');
            $table->text('link');
            $table->softDeletes(); // untuk fitur history / recycle bin
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
