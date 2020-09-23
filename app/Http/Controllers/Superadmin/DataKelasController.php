<?php

namespace App\Http\Controllers\Superadmin;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Kelas;
use Carbon\Carbon;
use Session;
use App\Imports\KelasImport;
use Maatwebsite\Excel\Facades\Excel;

class DataKelasController extends Controller
{
    public function index()
    {
        $kelass = Kelas::all();
        
       return view('superadmin.kelas.kelas',compact('kelass'));        
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
            
        Excel::import(new KelasImport, request()->file('file'));
        return back();
    }

    public function store(Request $request){
        $this->validate($request,[
            'nama' => ['required', 'string', 'max:255']
        ],
        [
            'nama.required' => 'Nama Wajib Diisi',
            'nama.max' => 'Nama Terlalu Panjang!'
        ]);

    
        $a = Kelas::where(['nama'=>$request->nama])->get();

        //return $a[1];

        if($a->count() > 0){
            Session::flash('statuscode','error');
        return redirect('superadmin/master/kelas')->with('status', 'Gagal Menambahkan Data Kelas!');
        }else{
        

        $kelass = new Kelas;
        
        $b = 'K'.Carbon::now()->format('ymdHi').rand(100,999);

        $kelass->id = $b;
        $kelass->nama = $request->input('nama');
        $kelass->created_at = Carbon::now();

        $kelass->save();
        
        Session::flash('statuscode','success');
        return redirect('superadmin/master/kelas')->with('status', 'Berhasil Menambahkan Data Kelas');
        }
    }

    public function edit(Request $request, $id)
    {
        $kelass = Kelas::findOrFail($id);
        return view('superadmin.kelas.edit', compact('kelass'));
    }

    public function update(Request $request, $id)
    {

        $this->validate($request,[
            'nama' => ['required', 'string', 'max:255']
            
        ],
        [
            'nama.required' => 'Nama Wajib Diisi',
            'nama.max' => 'Nama Terlalu Panjang!'
        ]);
        
        $kelass = Kelas::find($id);

        $kelass->nama = $request->input('nama');
        $kelass->updated_at = Carbon::now();

        $kelass->update();

        Session::flash('statuscode','success');
        return redirect('superadmin/master/kelas')->with('status','Data Kelas berhasil Diubah');
    }

    public function delete($id){

        $kelass = Kelas::findOrFail($id);
        $kelass->delete();

        Session::flash('statuscode','success');
        return redirect('superadmin/master/kelas')->with('status', 'Berhasil Hapus Kelas');
        
    }
}
