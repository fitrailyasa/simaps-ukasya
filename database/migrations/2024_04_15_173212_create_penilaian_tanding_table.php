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
            $table->foreignId('sudut')->nullable()->index();
            $table->foreignId('jadwal_tanding')->nullable()->index();
            $table->string('jenis');
            $table->integer('juri_1')->default(0);
            $table->integer('juri_2')->default(0);
            $table->integer('juri_3')->default(0);
            $table->integer('dewan')->default(0);
            $table->string('status')->default('tidak sah');
            $table->boolean('aktif')->default(true);
            $table->integer('babak');    
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
