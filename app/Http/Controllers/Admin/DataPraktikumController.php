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
use Carbon\Carbon;
use Session;

class DataPraktikumController extends Controller
{
    public function index()
    {
        $praktikums = Praktikum::join('dosen','praktikum.dosen_id','=','dosen.id')
        ->join('matkul','praktikum.matkul_id','=','matkul.id')
        ->join('jadwal','praktikum.jadwal_id','=','jadwal.id')
        ->join('ruangan','praktikum.ruangan_id','=','ruangan.id')
        ->join('kelas','praktikum.kelas_id','=','kelas.id')
        ->select('praktikum.matkul_id','praktikum.semester','praktikum.id','kelas.nama',
        'jadwal.hari','jadwal.jam_mulai','jadwal.jam_akhir','matkul.nama_matkul',
        'dosen.nama as nama_dosen','ruangan.nama_ruangan')
        ->get();

        $matkuls = Matkul::all();
        $idMatkul = $matkuls->pluck('matkul_id');

        $dosens = Dosen::all();
        $idDosen = $dosens->pluck('dosen_id');

        $jadwals = Jadwal::all();
        $idJadwal = $jadwals->pluck('jadwal_id');

        $ruangans = Ruangan::all();
        $idRuangan = $ruangans->pluck('ruangan_id');

        $kelass = Kelas::all();
        $idKelas = $kelass->pluck('kelas_id');

        $semesters = Praktikum::all();
        
       return view('admin.praktikum.praktikum',compact('praktikums','kelass','idKelas','matkuls','idMatkul','dosens','idDosen','jadwals','idJadwal','ruangans','idRuangan','semesters'));        
    }

    public function store(Request $request){
        $this->validate($request,[
            'ruangan_id' => 'required',
            'dosen_id' => 'required',
            'matkul_id' => 'required',
            'jadwal_id' => 'required',
            'kelas_id' => 'required',
            'semester' => 'required'
        ],
        [
            'ruangan_id.required' => 'Ruangan Wajib Diisi',
            'dosen_id.required' => 'Dosen Wajib Diisi',
            'matkul_id.required' => 'Matkul Wajib Diisi',
            'jadwal_id.required' => 'Jadwal Wajib Diisi',
            'kelas_id.required' => 'Kelas Wajib Diisi',
            'semester.required' => 'Semester Wajib Diisi',
        ]);
        
        $a = Praktikum::where(['ruangan_id'=>$request->ruangan_id,'dosen_id'=>$request->dosen_id,'matkul_id'=>$request->matkul_id,'jadwal_id'=>$request->jadwal_id,'kelas_id'=>$request->kelas_id,'semester'=>$request->semester])->get();
        $b = Praktikum::where(['jadwal_id'=>$request->jadwal_id,'kelas_id'=>$request->kelas_id])->get();

        //return $a[1];
        if(count($b) > 0 || count($a) > 0){
            Session::flash('statuscode','error');
        return redirect('admin/praktikum')->with('status', 'Gagal Menambahkan Data Praktikum');
        }
        else{
        $praktikums = new Praktikum;
        
        $praktikums->jadwal_id = $request->input('jadwal_id');
        $praktikums->dosen_id = $request->input('dosen_id');
        $praktikums->matkul_id = $request->input('matkul_id');
        $praktikums->ruangan_id = $request->input('ruangan_id');
        $praktikums->kelas_id = $request->input('kelas_id');
        $praktikums->semester = $request->input('semester');
        $praktikums->created_at = Carbon::today();

        $praktikums->save();
        
        Session::flash('statuscode','success');
        return redirect('admin/praktikum')->with('status', 'Berhasil Menambahkan Data Praktikum');
        }
    }

    public function edit(Request $request, $id)
    {
        $praktikums = Praktikum::findOrFail($id);

        $matkuls = Matkul::all();
        $idMatkul = $matkuls->pluck('id');

        $dosens = Dosen::all();
        $idDosen = $dosens->pluck('id');

        $jadwals = Jadwal::all();
        $idJadwal = $jadwals->pluck('id');

        $ruangans = Ruangan::all();
        $idRuangan = $ruangans->pluck('id');

        $kelass = Kelas::all();
        $idKelas = $kelass->pluck('id');

        $semesters = Praktikum::all()->where('id',$id)->first();
        return view('admin.praktikum.edit', compact('praktikums','kelass','idKelas','matkuls','idMatkul','dosens','idDosen','jadwals','idJadwal','ruangans','idRuangan','semesters'));
    }

    public function update(Request $request, $id)
    {

        $this->validate($request,[
            'ruangan_id' => 'required',
            'dosen_id' => 'required',
            'matkul_id' => 'required',
            'jadwal_id' => 'required',
            'kelas_id' => 'required',
            'semester' => 'required'
        ],
        [
            'ruangan_id.required' => 'Ruangan Wajib Diisi',
            'dosen_id.required' => 'Dosen Wajib Diisi',
            'matkul_id.required' => 'Matkul Wajib Diisi',
            'jadwal_id.required' => 'Jadwal Wajib Diisi',
            'kelas_id.required' => 'Kelas Wajib Diisi',
            'semester.required' => 'Semester Wajib Diisi',
        ]);
        
        $a = Praktikum::where(['ruangan_id'=>$request->ruangan_id,'dosen_id'=>$request->dosen_id,'matkul_id'=>$request->matkul_id,'jadwal_id'=>$request->jadwal_id,'kelas_id'=>$request->kelas_id,'semester'=>$request->semester])->get();
        $b = Praktikum::where(['jadwal_id'=>$request->jadwal_id,'kelas_id'=>$request->kelas_id])->get();

        //return $a[1];
        if(count($b) > 0 || count($a) > 0){
            Session::flash('statuscode','error');
        return redirect('admin/praktikum')->with('status', 'Gagal Mengubah Data Praktikum');
        }
        else{
        $praktikums = Praktikum::find($id);

        $praktikums->ruangan_id = $request->input('ruangan_id');
        $praktikums->dosen_id = $request->input('dosen_id');
        $praktikums->matkul_id = $request->input('matkul_id');
        $praktikums->jadwal_id = $request->input('jadwal_id');
        $praktikums->kelas_id = $request->input('kelas_id');
        $praktikums->semester = $request->input('semester');
        $praktikums->updated_at = Carbon::now();

        $praktikums->update();

        Session::flash('statuscode','success');
        return redirect('admin/praktikum')->with('status','Data Praktikum Berhasil Diubah');
        }
    }

    public function delete($id){

        $praktikums = Praktikum::findOrFail($id);
        $praktikums->delete();

        Session::flash('statuscode','success');
        return redirect('admin/praktikum')->with('status', 'Berhasil Hapus Praktikum');
        
    }
}
