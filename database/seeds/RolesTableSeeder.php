<?php

use Illuminate\Database\Seeder;
use App\Role;
use Carbon\Carbon;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Role::create([
            'id' => 1,
            'role' => 'admin',
            'created_at' => Carbon::now()
        ]);
        Role::create([
            'id' => 2,
            'role' => 'mahasiswa',
            'created_at' => Carbon::now()
            ]);
    }
}
