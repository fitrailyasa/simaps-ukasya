<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengundianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengundian', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('golongan');
            $table->string('kelas_kategori');
            $table->string('jenis_kelamin');
            $table->string('kontingen');
            $table->string('no_undian')->nullable();
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
        Schema::dropIfExists('pengundian');
    }
}
