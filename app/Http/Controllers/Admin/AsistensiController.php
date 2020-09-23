<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Kelas;
use App\Jadwal;
use App\Matkul;
use App\Dosen;
use App\Ruangan;
use App\Praktikum;
use App\Semester;
use App\Mahasiswa;
use App\Daftar;
use Session;
use Auth;
use Carbon\Carbon;

class AsistensiController extends Controller
{
    public function index()
    {
        $satu = Daftar::join('mahasiswa','daftar.mahasiswa_id','=','mahasiswa.id')
        ->join('user','mahasiswa.user_id','=','user.id')
        ->join('praktikum','praktikum.id','=','daftar.praktikum_id')
        ->where('daftar.status','=','diterima')
        ->select('user.nama as name1','praktikum.id as noPraktikum')
        ->orderBy(DB::raw("DATE_FORMAT(daftar.created_at,'%d-%m-%Y')"), 'asc')
        ->get();
        

        // return $satu;
        // $collection = [];

        // foreach($satu as $key=>$val){
        //     $akhir[$val->noPraktikum]=$val->name1;
        // }

        // return $akhir;

        $a = Praktikum::join('dosen','praktikum.dosen_id','=','dosen.id')
        ->join('matkul','praktikum.matkul_id','=','matkul.id')
        ->join('jadwal','praktikum.jadwal_id','=','jadwal.id')
        ->join('ruangan','praktikum.ruangan_id','=','ruangan.id')
        ->join('kelas','praktikum.kelas_id','=','kelas.id')
        ->select('praktikum.id as noPraktikum','praktikum.semester','kelas.nama','jadwal.hari','jadwal.jam_mulai', 'jadwal.jam_akhir','matkul.nama_matkul','dosen.nama as nama_dosen','ruangan.nama_ruangan')
        
        ->distinct()
        ->get();

        

        $matkul = Praktikum::join('matkul','praktikum.matkul_id','=','matkul.id')
        ->distinct()
        ->pluck('matkul.nama_matkul','matkul.id as idMatkul');

       return view('admin.asistensi.asistensi',compact('a','satu','users','matkul'));        
    }

    public function matkulAjax($id){
        if(empty($id)){
            $a['satu'] = Daftar::join('mahasiswa','daftar.mahasiswa_id','=','mahasiswa.id')
            ->join('user','mahasiswa.user_id','=','user.id')
            ->join('praktikum','praktikum.id','=','daftar.praktikum_id')
            ->where('daftar.status','=','diterima')
            ->select('user.nama as name1','praktikum.id as noPraktikum')
            ->orderBy(DB::raw("DATE_FORMAT(daftar.created_at,'%d-%m-%Y')"), 'asc')
            ->get();
            
    
            // return $satu;
            // $collection = [];
    
            // foreach($satu as $key=>$val){
            //     $akhir[$val->noPraktikum]=$val->name1;
            // }
    
            // return $akhir;
    
            $a['a'] = Praktikum::join('dosen','praktikum.dosen_id','=','dosen.id')
            ->join('matkul','praktikum.matkul_id','=','matkul.id')
            ->join('jadwal','praktikum.jadwal_id','=','jadwal.id')
            ->join('ruangan','praktikum.ruangan_id','=','ruangan.id')
            ->join('kelas','praktikum.kelas_id','=','kelas.id')
            ->select('praktikum.id as noPraktikum','praktikum.semester','kelas.nama','jadwal.hari','jadwal.jam_mulai', 'jadwal.jam_akhir','matkul.nama_matkul','dosen.nama as nama_dosen','ruangan.nama_ruangan')
            
            ->distinct()
            ->get();

            $a['matkul'] = Praktikum::join('matkul','praktikum.matkul_id','=','matkul.id')
        ->distinct()
        ->pluck('matkul.nama_matkul','matkul.id as idMatkul');
        }else{
            $a['satu'] = Daftar::join('mahasiswa','daftar.mahasiswa_id','=','mahasiswa.id')
            ->join('user','mahasiswa.user_id','=','user.id')
            ->join('praktikum','praktikum.id','=','daftar.praktikum_id')
            ->where('daftar.status','=','diterima')
            ->select('user.nama as name1','praktikum.id as noPraktikum')
            ->orderBy(DB::raw("DATE_FORMAT(daftar.created_at,'%d-%m-%Y')"), 'asc')
            ->get();
            
    
            // return $satu;
            // $collection = [];
    
            // foreach($satu as $key=>$val){
            //     $akhir[$val->noPraktikum]=$val->name1;
            // }
    
            // return $akhir;
    
            $a['a'] = Praktikum::join('dosen','praktikum.dosen_id','=','dosen.id')
            ->join('matkul','praktikum.matkul_id','=','matkul.id')
            ->join('jadwal','praktikum.jadwal_id','=','jadwal.id')
            ->join('ruangan','praktikum.ruangan_id','=','ruangan.id')
            ->join('kelas','praktikum.kelas_id','=','kelas.id')
            ->select('praktikum.id as noPraktikum','praktikum.semester','kelas.nama','jadwal.hari','jadwal.jam_mulai', 'jadwal.jam_akhir','matkul.nama_matkul','dosen.nama as nama_dosen','ruangan.nama_ruangan')
            ->where('praktikum.matkul_id','=',$id)
            ->distinct()
            ->get();

            $a['matkul'] = Praktikum::join('matkul','praktikum.matkul_id','=','matkul.id')
        ->distinct()
        ->pluck('matkul.nama_matkul','matkul.id as idMatkul');
        }
        return $a;
    }
}
