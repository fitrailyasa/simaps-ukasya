<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTgrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tgr', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('img')->nullable();
            $table->string('jenis_kelamin');
            $table->string('kontingen');    
            $table->string('kategori');
            $table->string('golongan');
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
        Schema::dropIfExists('tgr');
    }
}
