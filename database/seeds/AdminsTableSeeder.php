<?php

use Illuminate\Database\Seeder;
use App\Admin;
use App\User;
use Carbon\Carbon;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $a = User::select('id')->where('role_id', 1 )->get()->first();

        Admin::create([
            'id' => 'A'.Carbon::now()->format('ymdHi').rand(100,999),
            'user_id' => $a->id,
            'nip' => '001100000',
            'created_at' => Carbon::now()
        ]);
    }
}
