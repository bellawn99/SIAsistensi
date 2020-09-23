<?php

namespace App\Http\Controllers\Mahasiswa;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Daftar;
use App\Kelas;
use App\Matkul;
use App\Semester;
use App\Ruangan;
use App\Praktikum;
use App\Mahasiswa;
use App\User;
use App\Periode;
use Session;
use Auth;
use Carbon\Carbon;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumumans = Daftar::join('praktikum','praktikum.id','=','daftar.praktikum_id')
        ->join('mahasiswa','daftar.mahasiswa_id','=','mahasiswa.id')
        ->join('user','mahasiswa.user_id','=','user.id')
        ->join('matkul','praktikum.matkul_id','=','matkul.id')
        ->join('jadwal','praktikum.jadwal_id','=','jadwal.id')
        ->join('ruangan','praktikum.ruangan_id','=','ruangan.id')
        ->join('dosen','praktikum.dosen_id','=','dosen.id')
        ->join('kelas','praktikum.kelas_id','=','kelas.id')
        ->where('user.id',Auth::user()->id)
        ->select('praktikum.semester','daftar.id as noDaftar','daftar.status','praktikum.id',
        'kelas.nama','jadwal.hari','jadwal.jam_mulai','jadwal.jam_akhir',
        'matkul.nama_matkul','dosen.nama as nama_dosen', 'ruangan.nama_ruangan')
        ->get();  
        
        $now = Carbon::now()->subday(14);

        $awals = Periode::select('tgl_mulai')
        ->where('status','=','pengumuman')
        ->whereDate('tgl_mulai', '>=', $now->toDateString())
        ->get();

       // $status = Praktikum::leftJoint()->leftJoin('daftar','daftar.praktikum_id','=','praktikum.id')
       // ->select('status')->first();
        //return $awals;
       return view('mahasiswa.pengumuman.pengumuman',compact('pengumumans','awals'));        
    }

}
