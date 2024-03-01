<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalTandingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal_tanding', function (Blueprint $table) {
            $table->id();
            $table->string('partai');
            $table->foreignId('gelanggang');    
            $table->string('babak');
            $table->string('kelompok')->nullable();
            $table->string('sudut_biru');
            $table->string('sudut_merah');
            $table->string('next_sudut');
            $table->string('next_partai');
            $table->string('skor_biru')->nullable();
            $table->string('skor_merah')->nullable();
            $table->foreignId('pemenang')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jadwal_tanding');
    }
}
