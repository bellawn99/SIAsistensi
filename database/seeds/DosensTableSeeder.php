<?php

use Illuminate\Database\Seeder;
use App\Dosen;
use Carbon\Carbon;

class DosensTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Dosen::create([
            'id' => 'D'.Carbon::now()->format('ymdHi').rand(100,999),
            'nidn' => '0005058902',
            'nama' => 'Irkham Huda',
            'created_at' => Carbon::now()
        ]);
        Dosen::create([
            'id' => 'D'.Carbon::now()->format('ymdHi').rand(100,999),
            'nidn' => '0012018803',
            'nama' => 'Imam Fahrurrozi',
            'created_at' => Carbon::now()
            ]);
    }
}
