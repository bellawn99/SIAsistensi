<?php

namespace App\Http\Controllers\Superadmin;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ruangan;
use Carbon\Carbon;
use Session;
use App\Imports\RuanganImport;
use Maatwebsite\Excel\Facades\Excel;

class DataRuanganController extends Controller
{
    public function index()
    {
        $ruangans = Ruangan::all();
        return view('superadmin.ruangan.ruangan',compact('ruangans'));        
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

        Excel::import(new RuanganImport, request()->file('file'));
        return back();
    }

    public function store(Request $request){
        $this->validate($request,[
            'nama_ruangan' => ['required', 'string', 'max:255'],
        ],
        [
            'nama_ruangan.required' => 'Nama Ruangan Wajib Diisi',
            'nama_ruangan.max' => 'Nama Ruangan Terlalu Panjang!',
        ]);

    
        $a = Ruangan::where(['nama_ruangan'=>$request->nama_ruangan])->get();

        //return $a[1];

        if($a->count() > 0){
            Session::flash('statuscode','error');
        return redirect('superadmin/master/ruangan')->with('status', 'Gagal Menambahkan Data Ruangan');
        }else{
        

        $ruangans = new Ruangan;
        
        $b = 'R'.Carbon::now()->format('ymdHi').rand(100,999);

        $ruangans->id = $b;
        $ruangans->nama_ruangan = $request->input('nama_ruangan');
        $ruangans->created_at = Carbon::today();

        $ruangans->save();
        
        Session::flash('statuscode','success');
        return redirect('superadmin/master/ruangan')->with('status', 'Berhasil Menambahkan Data Ruangan');
        }
    }

    public function edit(Request $request, $id)
    {
        $ruangans = Ruangan::findOrFail($id);

        return view('superadmin.ruangan.edit', compact('ruangans'));
    }

    public function update(Request $request, $id)
    {

        $this->validate($request,[
            'nama_ruangan' => ['required', 'string', 'max:255'],
        ],
        [
            'nama_ruangan.required' => 'Nama Ruangan Wajib Diisi',
            'nama_ruangan.max' => 'Nama Ruangan Terlalu Panjang!',
        ]);
        
        $ruangans = Ruangan::find($id);

        $ruangans->nama_ruangan = $request->input('nama_ruangan');
        $ruangans->updated_at = Carbon::now();

        $ruangans->update();

        Session::flash('statuscode','success');
        return redirect('superadmin/master/ruangan')->with('status','Data Ruangan Berhasil Diubah');
    }

    public function delete($id){

        $ruangans = Ruangan::findOrFail($id);
        $ruangans->delete();

        Session::flash('statuscode','success');
        return redirect('superadmin/master/ruangan')->with('status', 'Berhasil Hapus Ruangan');
        
    }
}
