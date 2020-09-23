<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(MahasiswasTableSeeder::class);
        $this->call(AdminsTableSeeder::class);
        $this->call(DosensTableSeeder::class);
        $this->call(MatkulsTableSeeder::class);
        $this->call(RuangansTableSeeder::class);
        $this->call(JadwalsTableSeeder::class);
        $this->call(KelassTableSeeder::class);
        $this->call(SemestersTableSeeder::class);
        $this->call(PraktikumsTableSeeder::class);
        $this->call(KetentuansTableSeeder::class);
        $this->call(BeritasTableSeeder::class);
        $this->call(PeriodesTableSeeder::class);
        $this->call(DaftarsTableSeeder::class);
    }
}
