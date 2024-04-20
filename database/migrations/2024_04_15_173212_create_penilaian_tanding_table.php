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
        Schema::create('penilaian_tanding', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->foreignId('atlet')->nullable();
            $table->foreignId('jadwal_tanding')->nullable();
            $table->integer('babak')->default(1);    
            $table->integer('pukulan')->default(0);
            $table->integer('tendangan')->default(0);
            $table->integer('teguran')->default(0);
            $table->integer('jatuhan')->default(0);
            $table->integer('peringatan')->default(0);
            $table->integer('binaan')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian_tanding');
    }
};
