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

class PengajuanController extends Controller
{
    public function index()
    {
        $pengajuans = Daftar::leftJoin('mahasiswa','daftar.mahasiswa_id','=','mahasiswa.id')
        ->leftJoin('user','mahasiswa.user_id','=','user.id')
        ->leftJoin('praktikum','daftar.praktikum_id','=','praktikum.id')
        ->leftJoin('dosen','praktikum.dosen_id','=','dosen.id')
        ->leftJoin('matkul','praktikum.matkul_id','=','matkul.id')
        ->leftJoin('jadwal','praktikum.jadwal_id','=','jadwal.id')
        ->leftJoin('ruangan','praktikum.ruangan_id','=','ruangan.id')
        ->join('kelas','praktikum.kelas_id','=','kelas.id')
        ->select('user.id as userId','daftar.created_at','daftar.praktikum_id as praktikum','daftar.id as noDaftar','user.nama as user','praktikum.semester','mahasiswa.khs',
        'mahasiswa.id as id','mahasiswa.ipk','daftar.status','kelas.nama','jadwal.hari','jadwal.jam_mulai',
        'jadwal.jam_akhir','matkul.nama_matkul','dosen.nama as nama_dosen','ruangan.nama_ruangan')
        ->orderBy(DB::raw("DATE_FORMAT(daftar.created_at,'%d-%m-%Y')"), 'asc')
        ->get();  
        
       // $status = Praktikum::leftJoint()->leftJoin('daftar','daftar.praktikum_id','=','praktikum.id')
       // ->select('status')->first();
        //return $daftars;
       return view('admin.pengajuan.pengajuan',compact('pengajuans'));        
    }

    public function editStat($id)
{
    //
    $pengajuans = Daftar::findOrFail($id);
    return view('admin.pengajuan.pengajuan', ['id' => $id]);
}

    public function statusUpdate(Request $request,$id=0){    

        $id = $request->noDaftar;
            $daftars = Daftar::find($id);
            $daftars = Daftar::where('id',$id)->first();
            $praktikum = $request->praktikum;
        
            $a = Daftar::where('praktikum_id','=',$praktikum)->get();
            
        if(count($a)>2){
            Session::flash('statuscode','error');
            return redirect('admin/pengajuan')->with('status', 'Asisten Praktikum Sudah Cukup!');
        }else{
        if($daftars->status === "daftar" || $daftars->status === "ditolak"){
            
            $daftars->status = 'diterima';
            $daftars->updated_at = Carbon::today();

            $daftars->save();
        
            Session::flash('statuscode','success');
            return redirect('admin/pengajuan')->with('status', 'Berhasil Menerima Asistensi');
        }else if($daftars->status === "diterima"){
            // $daftars = new Daftar;
            // $daftars->id = $request->noDaftar;
            // $daftars->praktikum_id = $request->id;
            // $daftars->user_id = $request->user;
            // $daftars->status = 'ditolak';

            // $daftars->save();
        
            // Session::flash('statuscode','success');
            // return redirect('admin/pengajuan')->with('status', 'Berhasil Menolak Asistensi');
            $daftars->status = 'ditolak';
            $daftars->updated_at = Carbon::today();

            $daftars->save();

            Session::flash('statuscode','success');
            return redirect('admin/pengajuan')->with('status', 'Berhasil Menolak Asistensi');
        }
    }
    }
}
