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
        Schema::create('verifikasi_pelanggaran', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->foreignId('jadwal_tanding');
            $table->foreignId('dewan');
            $table->json('data')->nullable(); 
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verifikasi_pelanggaran');
    }
};
