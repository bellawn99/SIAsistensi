<?php

use Illuminate\Database\Seeder;
use App\Matkul;
use Carbon\Carbon;

class MatkulsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Matkul::create([
            'id' => 'M'.Carbon::now()->format('ymdHi').rand(100,999),
            'kode_vmk' => 'V3KI2212',
            'nama_matkul' => 'Praktikum Pemrograman Aplikasi Perangkat Bergerak 2',
            'sks' => 2,
            'created_at' => Carbon::now()
        ]);
        Matkul::create([
            'id' => 'M'.Carbon::now()->format('ymdHi').rand(100,999),
            'kode_vmk' => 'VMK 1204',
            'nama_matkul' => 'KL Pemrograman Web I',
            'sks' => 2,
            'created_at' => Carbon::now()
        ]);
    }
}
