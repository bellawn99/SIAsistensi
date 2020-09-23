<?php

namespace App\Http\Controllers\Mahasiswa;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Kelas;
use App\Jadwal;
use App\Matkul;
use App\Dosen;
use App\Ruangan;
use App\User;
use App\Praktikum;
use App\Semester;
use App\Mahasiswa;
use App\Daftar;
use App\Periode;
use Session;
use Auth;
use Carbon\Carbon;


class DaftarController extends Controller
{
    public function index()
    {        
        $daftars = Praktikum::join('dosen','praktikum.dosen_id','=','dosen.id')
        ->join('matkul','praktikum.matkul_id','=','matkul.id')
        ->join('jadwal','praktikum.jadwal_id','=','jadwal.id')
        ->join('ruangan','praktikum.ruangan_id','=','ruangan.id')
        ->join('kelas','praktikum.kelas_id','=','kelas.id')
        ->select('praktikum.id as praktikum','praktikum.semester','praktikum.id', 'kelas.nama',
        'jadwal.hari','jadwal.jam_mulai','jadwal.jam_akhir',
        'matkul.nama_matkul','dosen.nama as nama_dosen','ruangan.nama_ruangan')
        ->get();


        $now = Carbon::now();

        $awals = Periode::select('tgl_mulai')
        ->whereDate('tgl_mulai', '<=', $now->toDateString())
        ->where('status','=','daftar')
        ->get();

        $akhirs = Periode::select('tgl_selesai')
        ->whereDate('tgl_selesai', '>=', $now->toDateString())
        ->where('status','=','daftar')
        ->get();

        $usr = Daftar::join('mahasiswa','daftar.mahasiswa_id','=','mahasiswa.id')
        ->select('daftar.*')
        ->where('mahasiswa.user_id',Auth::user()->id)->get();
        $a = Daftar::join('mahasiswa','daftar.mahasiswa_id','=','mahasiswa.id')
        ->select('daftar.*')
        ->where('mahasiswa.user_id',Auth::user()->id)->first();

        // $a = Daftar::->all();
        foreach($usr as $key=>$val){
            $users[$val->praktikum_id]=$val->id;
            $users[$val->status]=$val->id;
        }

        // return $a;

        // return $users['diterima'];
        
        // return response()->json(['praktikum'=>$daftars,'awal'=>$awals,'akhir'=>$akhirs,'user'=>$users,'tes'=>$tes]);
        // exit();
       // $status = Praktikum::leftJoint()->leftJoin('daftar','daftar.praktikum_id','=','praktikum.id')
       // ->select('status')->first();
    //    dd($awals);
    return view('mahasiswa.daftar.daftar',compact('daftars','awals','akhirs','users','tes','a'));        
    }

    public function store(Request $request){

        $z = Mahasiswa::where('user_id',Auth::user()->id)->first();
    
        $a = Daftar::join('praktikum','daftar.praktikum_id','=','praktikum.id')
        ->where(['mahasiswa_id'=>$z->id,'praktikum_id'=>$request->id])->first();

        // return count($a);

        // return $a->status;

        $ngecek = Daftar::where(['mahasiswa_id'=>$z->id,'status'=>'daftar'])->get();


        //return $a[1];

        if(count($ngecek) == 2){
            Session::flash('statuscode','error');
        return redirect('mahasiswa/daftar')->with('status', 'Gagal Mendaftar!');
        }else{
            $tes = User::join('mahasiswa','user.id','=','mahasiswa.user_id')
            ->where('mahasiswa.user_id',Auth::user()->id)->first()->toArray();

        if(is_null($tes['nama']) || is_null($tes['username']) || is_null($tes['foto']) || is_null($tes['nim']) || is_null($tes['nik']) || is_null($tes['jk']) || is_null($tes['tempat']) || is_null($tes['tgl_lahir']) || is_null($tes['alamat']) || is_null($tes['prodi']) || is_null($tes['khs']) || is_null($tes['semester']) || is_null($tes['nama_bank']) || is_null($tes['no_rekening']) || is_null($tes['nama_rekening'])){
            Session::flash('statuscode','error');
        return redirect('mahasiswa/daftar')->with('status', 'Silahkan Melengkapi Profil Terlebih Dahulu!');
        }else{
        if(empty($a)){
        $daftars = new Daftar;
        
        $b = 'D'.Carbon::now()->format('ymdHi').rand(100,999);

        $now = Carbon::now();

        $awals = Periode::select('id','tgl_mulai')
        ->whereDate('tgl_mulai', '<=', $now->toDateString())
        ->where('status','=','daftar')
        ->first();

        $mahasiswa_id = Mahasiswa::where('user_id',Auth::user()->id)->first();

        $daftars->id = $b;
        $daftars->mahasiswa_id = $mahasiswa_id->id;
        $daftars->periode_id = $awals->id;
        $daftars->praktikum_id = $request->id;
        $daftars->status = 'daftar';
        $daftars->created_at = Carbon::today();

        $daftars->save();
        
        Session::flash('statuscode','success');
        return redirect('mahasiswa/daftar')->with('status', 'Berhasil Mendaftar');
        }
        if($a->status == 'ditolak'){
            $a->status = 'daftar';
    
            $a->updated_at = Carbon::today();
            $a->save();
            
            Session::flash('statuscode','success');
            return redirect('mahasiswa/daftar')->with('status', 'Berhasil Mendaftar');
            }
        }
        }
        //return $request->id;
        
    }

    public function delete($id){

        $daftars = Daftar::findOrFail($id);
        $daftars->delete();

        Session::flash('statuscode','success');
        return redirect('mahasiswa/daftar')->with('status', 'Berhasil Membatalkan Pendaftaran');
        
    }

}
