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
        Schema::create('penilaian_regu', function (Blueprint $table) {
            $table->id();
            $table->index('id');
            $table->string('uuid')->unique();
            $table->foreignId('sudut');
            $table->foreignId('jadwal_regu');
            $table->foreignId('juri');
            $table->integer('salah')->default(0);
            $table->integer('penalty')->default(0);
            $table->float('flow_skor')->default(0);
            $table->float('skor')->default(9.90);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian_regu');
    }
};
