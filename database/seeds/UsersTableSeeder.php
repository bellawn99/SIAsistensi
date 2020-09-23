<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $mhs = Role::select('id')->where('role','mahasiswa')->get()->first();
        $admin = Role::select('id')->where('role','admin')->get()->first();

        User::create([
            'id' => \Carbon\Carbon::now()->format('ymd').rand(1000,9999),
            'role_id' => $admin->id,
            'email' => 'admin@mail.com',
            'nama' => 'Admin',
            'username' => '123456',
            'password' => bcrypt('123456'),
            'no_hp' => '0877380088068',
            'foto' => 'avatar.png',
            'created_at' => Carbon::now()
        ]);

        User::create([
            'id' => \Carbon\Carbon::now()->format('ymd').rand(1000,9999),
            'role_id' => $mhs->id,
            'email' => 'bwulan99@gmail.com',
            'nama' => 'Bella Wulan N',
            'username' => '410828',
            'password' => bcrypt('410828'),
            'no_hp' => '081804007078',
            'foto' => 'avatar.png',
            'created_at' => Carbon::now()
        ]);

    }
}
