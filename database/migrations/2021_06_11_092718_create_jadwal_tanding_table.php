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
            $table->integer('partai');
            $table->foreignId('gelanggang');
            $table->string('babak');
            $table->string('tahap')->default('persiapan');
            $table->foreignId('sudut_biru')->nullable();
            $table->foreignId('sudut_merah')->nullable();
            $table->integer('skor_merah')->default(0);
            $table->integer('skor_biru')->default(0);
            $table->integer('next_sudut');
            $table->integer('next_partai');
            $table->integer('babak_tanding')->default(1);
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
