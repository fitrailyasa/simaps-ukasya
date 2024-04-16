<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTandingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tanding', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('img')->nullable();
            $table->string('jenis_kelamin');
            $table->string('negara');
            $table->string('tinggi_badan');
            $table->string('berat_badan');
            $table->string('kontingen');    
            $table->string('kelas');
            $table->string('golongan');    
            $table->integer('pukulan')->default(0);
            $table->integer('tendangan')->default(0);
            $table->integer('teguran')->default(0);
            $table->integer('jatuhan')->default(0);
            $table->integer('peringatan')->default(0);
            $table->integer('binaan')->default(0);
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
        Schema::dropIfExists('tanding');
    }
}
