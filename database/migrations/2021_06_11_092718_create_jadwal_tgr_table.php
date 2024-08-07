<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalTGRTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal_tgr', function (Blueprint $table) {
            $table->id();
            $table->integer('partai')->nullable();
            $table->foreignId('gelanggang')->nullable();
            $table->string('babak')->nullable();
            $table->string('tahap')->default('menunggu');
            $table->string('jenis_kemenangan')->default('Angka');
            $table->string('jenis')->nullable();
            $table->foreignId('sudut_biru')->nullable();
            $table->foreignId('sudut_merah')->nullable();
            $table->integer('next_sudut')->nullable();
            $table->integer('next_partai')->nullable();
            $table->float('skor_biru')->default(0);
            $table->float('skor_merah')->default(0);
            $table->foreignId('tampil')->nullable();
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
        Schema::dropIfExists('jadwal_tgr');
    }
}
