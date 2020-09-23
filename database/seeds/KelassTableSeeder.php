<?php

use Illuminate\Database\Seeder;
use App\Kelas;
use Carbon\Carbon;

class KelassTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    

        Kelas::create([
            'id' => 'K'.Carbon::now()->format('ymdHi').rand(100,999),
            'nama' => 'BB',
            'created_at' => Carbon::now()
        ]);
        Kelas::create([
            'id' => 'K'.Carbon::now()->format('ymdHi').rand(100,999),
            'nama' => 'AB',
            'created_at' => Carbon::now()
            ]);
    }
}
