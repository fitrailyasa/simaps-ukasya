<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGelanggangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gelanggang', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('waktu');
            $table->string('audio')->nullable();
            $table->string('jenis');
            $table->integer('jumlah_tanding')->default(0);    
            $table->integer('jumlah_tgr')->default(0);    
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
        Schema::dropIfExists('gelanggang');
    }
}
