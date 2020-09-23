<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMahasiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('user_id',20)->nullable();
            $table->string('nim',20)->nullable();
            $table->string('nik',20)->nullable();
            $table->string('npwp',20)->nullable();
            $table->enum('jk',['P','L'])->nullable();
            $table->string('tempat',20)->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->string('alamat',50)->nullable();
            $table->string('prodi',50)->nullable();
            $table->string('khs',30)->nullable();
            $table->decimal('ipk',10,2)->nullable();
            $table->integer('semester')->nullable();
            $table->string('nama_bank',50)->nullable();
            $table->string('no_rekening',50)->unique()->nullable();
            $table->string('nama_rekening',30)->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mahasiswa');
    }
}
