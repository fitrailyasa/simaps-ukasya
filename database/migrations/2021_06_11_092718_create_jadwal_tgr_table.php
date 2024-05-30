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
            $table->integer('partai');
            $table->foreignId('gelanggang');
            $table->string('babak');
            $table->string('tahap')->default('persiapan');
            $table->foreignId('sudut_biru');
            $table->foreignId('sudut_merah');
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
