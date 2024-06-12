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
        Schema::create('penalty_solo', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->foreignId('sudut');
            $table->foreignId('jadwal_solo');
            $table->foreignId('dewan');
            $table->float('performa_waktu')->default(0);
            $table->integer('toleransi_waktu')->default(0);
            $table->integer('keluar_arena')->default(0);
            $table->integer('menyentuh_lantai')->default(0);
            $table->integer('pakaian')->default(0);
            $table->integer('tidak_bergerak')->default(0);
            $table->integer('senjata_jatuh')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penalty_solo');
    }
};
