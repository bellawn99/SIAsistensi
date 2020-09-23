<?php

use Illuminate\Database\Seeder;
use App\Ketentuan;
use Carbon\Carbon;

class KetentuansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ketentuan::create([
            'id' => 1,
            'ketentuan' => 'Mahasiswa aktif Universitas Gadjah Mada',
            'created_at' => Carbon::now()
        ]);

        Ketentuan::create([
            'id' => 2,
            'ketentuan' => 'IPK minimal 3.00',
            'created_at' => Carbon::now()
        ]);

        Ketentuan::create([
            'id' => 3,
            'ketentuan' => 'Minimal memperoleh nilai B pada matakuliah
            yang bersangkutan',
            'created_at' => Carbon::now()
        ]);

        Ketentuan::create([
            'id' => 4,
            'ketentuan' => 'Pernah mengambil matakuliah yang sama atau
            disetarakan',
            'created_at' => Carbon::now()
        ]);

        Ketentuan::create([
            'id' => 5,
            'ketentuan' => 'Tidak sedang mengulang matakuliah yang
            diasisteni',
            'created_at' => Carbon::now()
        ]);

        Ketentuan::create([
            'id' => 6,
            'ketentuan' => 'Setiap mahasiswa diperbolehkan memilih 2 matakuliah untuk diasisteni',
            'created_at' => Carbon::now()
        ]);
    }
}
