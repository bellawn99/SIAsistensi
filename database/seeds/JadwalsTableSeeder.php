<?php

use Illuminate\Database\Seeder;
use App\Jadwal;
use App\Ruangan;
use Carbon\Carbon;

class JadwalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Jadwal::create([
            'id' => 'J'.Carbon::now()->format('ymdHi').rand(100,999),
            'hari' => 'Rabu',
            'jam_mulai' => '12:00:00',
            'jam_akhir' => '13:40:00',
            'created_at' => Carbon::now()
        ]);
        Jadwal::create([
            'id' => 'J'.Carbon::now()->format('ymdHi').rand(100,999),
            'hari' => 'Kamis',
            'jam_mulai' => '09:00:00',
            'jam_akhir' => '10:40:00',
            'created_at' => Carbon::now()
            ]);
    }
}
