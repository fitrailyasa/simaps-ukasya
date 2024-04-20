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
        Schema::create('pukulan_event_sent', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->foreignId('jadwal_tanding');
            $table->foreignId('sudut');
            $table->integer('event_sent')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pukulan_event_sent');
    }
};
