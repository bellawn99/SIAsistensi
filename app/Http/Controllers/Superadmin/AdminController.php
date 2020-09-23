<?php

namespace App\Http\Controllers\Superadmin;

use App\User;
use App\Mahasiswa;
use App\Daftar;
use App\Praktikum;
use App\Periode;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Charts;
use Notification;
use App\Notifications\Pengumuman;

class AdminController extends Controller
{
    public function home()
    {
        $data['mhs']=Mahasiswa::all();
        $data['jml_mhs']=$data['mhs']->count();

        $data['pengajuan']=Daftar::where('status','daftar')->get();
        $data['jml_pengajuan']=$data['pengajuan']->count();

        $data['prak']=Praktikum::all();
        $data['jml_prak']=$data['prak']->count();

        $now = Carbon::today();

        $daftars = Praktikum::join('dosen','praktikum.dosen_id','=','dosen.id')
        ->join('matkul','praktikum.matkul_id','=','matkul.id')
        ->join('jadwal','praktikum.jadwal_id','=','jadwal.id')
        ->leftJoin('daftar','daftar.praktikum_id','=','praktikum.id')
        ->join('periode','daftar.periode_id','=','periode.id')
        ->join('mahasiswa','daftar.mahasiswa_id','=','mahasiswa.id')
        ->join('user','mahasiswa.user_id','=','user.id')
        ->join('kelas','praktikum.kelas_id','=','kelas.id')
        ->select('praktikum.semester','user.nama as pengguna','user.foto','matkul.sks','daftar.status','kelas.nama as kelas','jadwal.hari','jadwal.jam_mulai','jadwal.jam_akhir','matkul.nama_matkul')
        ->where('daftar.created_at','=',$now)
        ->get()->toArray();

        $z=Carbon::now();
        $bulan = $z->month;

        $semester = Periode::where("status",'=','daftar')->select('semester')->first();
        $thn_ajaran= Periode::select('thn_ajaran')->distinct()->get();

        return view('superadmin.dashboard',$data)->with('now',$now)->with('daftars',$daftars)
        ->with('semester',$semester)
        ->with('thn_ajaran',$thn_ajaran)
        ->with('bulan',json_encode($bulan,JSON_NUMERIC_CHECK));
    }

    public function get_data(Request $request)   {

        $get_thn = $_GET['z'];
        $gett_ex = $_GET['v'];

        $periode = DB::table('periode')->where('thn_ajaran', $get_thn)->where('semester', $gett_ex)->first();
        if($periode){
        $batas = DB::table('daftar')->where('periode_id',$periode->id)->get();
        
        $grap=Daftar::join('praktikum','daftar.praktikum_id','=','praktikum.id')
        ->join('matkul','praktikum.matkul_id','=','matkul.id')
        ->select(DB::raw('COUNT(daftar.praktikum_id) as jml'),'matkul.nama_matkul')
        ->where('daftar.periode_id',$periode->id)
        ->orderBy('jml','desc')
        ->groupBy('matkul.nama_matkul')
        ->get();
    
        $mencoba = Daftar::where('periode_id',$periode->id)->get()->count();
        
        
        if($grap->count() > 0){
        foreach($grap as $row) {
            $grafik['nama'][] = $row->nama_matkul;
            $grafik['jml'][] = round((int) ($row->jml*100)/$mencoba,2);
        }
        }else{
            $grafik['nama']=['Tidak Ada Matakuliah Favorit'];
            $grafik['jml']=['0'];
        }


        if (count($batas)>0){
        $click = Daftar::select(DB::raw("SUM(status) as jumlah"),(DB::raw("MONTH(created_at) as created_at")))
        ->where('periode_id',$periode->id)
        ->groupBy('created_at')
        ->orderBy(DB::raw("MONTH(created_at)"))
        ->get();
        
        foreach($click as $key=>$val){
            $dtgrfk[$val->created_at]=$val->jumlah;
        }

        
        
        foreach($batas as $iki){
            $thn = date("Y", strtotime($iki->created_at));
            $bulan = date("m", strtotime($iki->created_at));
            }

        $dim=cal_days_in_month(CAL_GREGORIAN,$bulan,$thn);
        }else{

           $click='';
            $dim=cal_days_in_month(CAL_GREGORIAN,date('m'),date('Y'));
        }
        for($i=1;$i<=12;$i++){
            
            if(isset($dtgrfk[$i])){
                $grfk[$i]=$dtgrfk[$i];
            }else{
                $grfk[$i]=0;
            }
        }
        foreach($grfk as $k=>$v){
            $argfx[]=$v;
        }
        }else{
            $argfx=array();
            $grafik=array('nama'=>array('Tidak ada matakuliah favorit'),'jml'=>array('0'));
        }
        //$arrgrfk=implode(",",$grfk);

        return response()->json(['grafik' =>$argfx,'donut'=>$grafik]);

    }

}
