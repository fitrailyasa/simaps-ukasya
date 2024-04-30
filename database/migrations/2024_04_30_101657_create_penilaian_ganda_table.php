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
        Schema::create('penilaian_ganda', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->foreignId('sudut_biru');
            $table->foreignId('sudut_merah');
            $table->foreignId('jadwal_ganda');
            $table->foreignId('juri');
            $table->integer('penalty')->default(0);
            $table->float('attack_skor')->default(0);
            $table->float('firmness_skor')->default(0);
            $table->float('soulfulness_skor')->default(0);
            $table->float('skor')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian_ganda');
    }
};
