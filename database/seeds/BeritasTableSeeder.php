<?php

use Illuminate\Database\Seeder;
use App\Berita;
use App\Admin;
use Carbon\Carbon;

class BeritasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $a = Admin::select('id')->where('nip', '001100000' )->get()->first();

        Berita::create([
            'id' => 'B'.Carbon::now()->format('ymdHi').rand(100,999),
            'judul' => 'Pendaftaran Asistensi Semester Genap TA 2020/2021',
            'isi' => 'PERSIAPKAN DIRIMU !
            
Kami dari Admin Asistensi menyelenggarakan Open Recruitment Asisten Praktikum Semester Genap Tahun Akademik 2020/2021.
            
Catat tanggalnya :
Pendaftaran : 15 Januari 2020 - 30 Januari 2020
            
Informasi lebih lanjut
CP : 088-888-888-888
Daftarkan segera dan jadilah bagian dari kami.',
            'foto' => 'daftar.png',
            'created_at' => '2020-01-15',
            'admin_id' => $a->id
        ]);
    }
}
