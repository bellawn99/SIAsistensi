<?php

namespace App\Http\Controllers\Superadmin;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jadwal;
use Carbon\Carbon;
use Session;
use App\Imports\JadwalImport;
use Maatwebsite\Excel\Facades\Excel;

class DataJadwalController extends Controller
{
    public function index()
    {
        $jadwals = Jadwal::all();
        return view('superadmin.jadwal.jadwal',compact('jadwals'));        
    }

    public function csv_import(Request $request)
    {
        $this->validate($request,[
            'file' => 'required|mimes:xlsx, xls',
        ],
        [
            'file.required' => 'File Wajib Diisi',
            'file.mimes' => 'File Harus Berupa File: xlsx, xls!',
        ]);

        Excel::import(new JadwalImport, request()->file('file'));
        return back();
    }

    public function store(Request $request){
        $this->validate($request,[
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_akhir' => 'required',
        ],
        [
            'hari.required' => 'Hari Wajib Diisi',
            'jam_mulai.required' => 'Jam Mulai Wajib Diisi',
            'jam_akhir.required' => 'Jam Akhir Wajib Diisi'
        ]);

    
        $a = Jadwal::where(['hari'=>$request->hari,'jam_mulai'=>$request->jam_mulai,'jam_akhir'=>$request->jam_akhir])->get();

        //return $a[1];

        if($a->count() > 0){
            Session::flash('statuscode','error');
        return redirect('superadmin/master/jadwal')->with('status', 'Gagal Menambahkan Data Jadwal!');
        }else{
        

        $jadwals = new Jadwal;
        
        $b = 'J'.Carbon::now()->format('ymdHi').rand(100,999);

        $jadwals->id = $b;
        $jadwals->hari = $request->input('hari');
        $jadwals->jam_mulai = $request->input('jam_mulai');
        $jadwals->jam_akhir = $request->input('jam_akhir');
        $jadwals->created_at = Carbon::today();

        $jadwals->save();
        
        Session::flash('statuscode','success');
        return redirect('superadmin/master/jadwal')->with('status', 'Berhasil Menambahkan Data Jadwal');
        }
    }

    public function edit(Request $request, $id)
    {
        $jadwals = Jadwal::findOrFail($id);

        return view('superadmin.jadwal.edit', compact('jadwals'));
    }

    public function update(Request $request, $id)
    {

        $this->validate($request,[
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_akhir' => 'required',
        ],
        [
            'hari.required' => 'Hari Wajib Diisi',
            'jam_mulai.required' => 'Jam Mulai Wajib Diisi',
            'jam_akhir.required' => 'Jam Akhir Wajib Diisi'
        ]);
        
        $jadwals = Jadwal::find($id);

        $jadwals->hari = $request->input('hari');
        $jadwals->jam_mulai = $request->input('jam_mulai');
        $jadwals->jam_akhir = $request->input('jam_akhir');
        $jadwals->updated_at = Carbon::now();

        $jadwals->update();

        Session::flash('statuscode','success');
        return redirect('superadmin/master/jadwal')->with('status','Data Jadwal Berhasil Diubah');
    }

    public function delete($id){

        $jadwals = Jadwal::findOrFail($id);
        $jadwals->delete();

        Session::flash('statuscode','success');
        return redirect('superadmin/master/jadwal')->with('status', 'Berhasil Hapus Jadwal');
        
    }
}
