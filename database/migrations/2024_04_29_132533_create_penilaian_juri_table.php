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
        Schema::create('penilaian_juri', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->foreignId('sudut');
            $table->foreignId('juri');
            $table->foreignId('gelanggang');
            $table->integer('partai');
            $table->json('data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian_juri');
    }
};
