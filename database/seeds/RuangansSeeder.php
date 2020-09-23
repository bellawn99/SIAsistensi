<?php

use Illuminate\Database\Seeder;
use App\Ruangan;
use Carbon\Carbon;

class RuangansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Ruangan::create([
            'id' => 'R'.Carbon::now()->format('ymdHi').rand(100,999),
            'nama_ruangan' => 'HY Labkom 5',
            'created_at' => Carbon::now()
        ]);
        Ruangan::create([
            'id' => 'R'.Carbon::now()->format('ymdHi').rand(100,999),
            'nama_ruangan' => 'HY RPL 1',
            'created_at' => Carbon::now()
            ]);
    }
}
