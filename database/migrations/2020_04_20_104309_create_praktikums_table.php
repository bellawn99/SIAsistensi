<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePraktikumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('praktikum', function (Blueprint $table) {
            $table->increments('id');
            $table->string('dosen_id',20)->nullable();
            $table->string('matkul_id',20)->nullable();
            $table->string('jadwal_id',20)->nullable();
            $table->string('ruangan_id',20)->nullable();
            $table->string('kelas_id',20)->nullable();
            $table->enum('semester',[1,2,3,4,5,6])->nullable();
            $table->timestamps();
            $table->foreign('dosen_id')->references('id')->on('dosen');
            $table->foreign('matkul_id')->references('id')->on('matkul');
            $table->foreign('jadwal_id')->references('id')->on('jadwal');
            $table->foreign('ruangan_id')->references('id')->on('ruangan');
            $table->foreign('kelas_id')->references('id')->on('kelas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('praktikum');
    }
}
