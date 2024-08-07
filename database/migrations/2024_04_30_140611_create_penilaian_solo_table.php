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
        Schema::create('penilaian_solo', function (Blueprint $table) {
            $table->id();
            $table->index('id');
            $table->string('uuid')->unique();
            $table->foreignId('sudut');
            $table->foreignId('jadwal_solo');
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
        Schema::dropIfExists('penilaian_solo');
    }
};
