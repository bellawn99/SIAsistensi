<?php

use Illuminate\Database\Seeder;
use App\Praktikum;
use App\Mahasiswa;
use App\Daftar;
use App\Periode;
use Carbon\Carbon;

class DaftarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $a = Mahasiswa::select('id')->where('nim', '410828')->get()->first();

        $b = Periode::select('id')->where('status','daftar')->get()->first();

        $c = Praktikum::select('id')->where('id',1)->get()->first();

        Daftar::create([
            'id' => 'D'.Carbon::now()->format('ymdHi').rand(100,999),
            'periode_id' => $b->id,
            'mahasiswa_id' => $a->id,
            'praktikum_id' => $c->id,
            'status' => 'daftar',
            'created_at' => Carbon::now(),
        ]);
    }
}
