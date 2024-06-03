<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimbangUlangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timbang_ulang', function (Blueprint $table) {
            $table->id();
            $table->integer('partai');
            $table->foreignId('gelanggang');
            $table->string('babak');
            $table->string('kelas');
            $table->foreignId('sudut_biru');
            $table->integer('berat_biru')->nullable()->default(0);
            $table->string('status_biru')->nullable();
            $table->foreignId('sudut_merah');
            $table->integer('berat_merah')->nullable()->default(0);
            $table->string('status_merah')->nullable();
            $table->string('pemenang')->nullable();
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
        Schema::dropIfExists('timbang_ulang');
    }
}
