<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeriodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periode', function (Blueprint $table) {
            $table->string('id',20)->primary();
            $table->string('berita_id',20)->nullable();
            $table->date('tgl_mulai');
            $table->date('tgl_selesai')->nullable();
            $table->string('thn_ajaran',15);
            $table->enum('semester',['genap','ganjil']);
            $table->enum('status',['daftar','pengumuman']);
            $table->timestamps();
            $table->foreign('berita_id')->references('id')->on('berita');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('periode');
    }
}
