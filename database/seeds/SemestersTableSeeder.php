<?php

use Illuminate\Database\Seeder;
use App\Semester;
use Carbon\Carbon;

class SemestersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    

        Semester::create([
            'id' => 'S'.Carbon::now()->format('ymdHi').rand(100,999),
            'semester' => 1
        ]);
        Semester::create([
            'id' => 'S'.Carbon::now()->format('ymdHi').rand(100,999),
            'semester' => 2
            ]);
    }
}
