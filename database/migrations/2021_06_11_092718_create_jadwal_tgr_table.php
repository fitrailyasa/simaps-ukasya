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
            $table->string('partai');
            $table->string('tanggal');
            $table->foreignId('gelanggang');    
            $table->string('babak');
            $table->string('kelompok');
            $table->string('pemain_biru');
            $table->string('partai_biru');
            $table->string('pemain_merah');
            $table->string('partai_merah'); 
            $table->string('status')->nullable();
            $table->string('pemenang')->nullable();
            $table->string('aktif')->nullable();
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
