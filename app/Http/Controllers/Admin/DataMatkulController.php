<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Matkul;
use Carbon\Carbon;
use Session;
use App\Imports\MatkulImport;
use Maatwebsite\Excel\Facades\Excel;

class DataMatkulController extends Controller
{
    public function index()
    {
        $matkuls = Matkul::all();
        return view('admin.matkul.matkul',compact('matkuls'));        
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

        Excel::import(new MatkulImport, request()->file('file'));
        return back();
    }

    public function store(Request $request){
        $this->validate($request,[
            'kode_vmk' => ['required', 'string', 'max:10'],
            'nama_matkul' => ['required', 'string', 'max:255'],
            'sks' => ['required', 'string', 'max:2'],
        ],
        [
            'kode_vmk.required' => 'Kode VMK Wajib Diisi',
            'kode_vmk.max' => 'Kode VMK Terlalu Panjang!',
            'nama_matkul.required' => 'Nama Matkul Wajib Diisi',
            'nama_matkul.max' => 'Nama Matkul Terlalu Panjang!',
            'sks.required' => 'SKS Wajib Diisi',
            'sks.max' => 'SKS Terlalu Panjang!',
        ]);

    
        
        
        $a = Matkul::where(['kode_vmk'=>$request->kode_vmk,'nama_matkul'=>$request->nama_matkul, 'sks'=>$request->sks])->get();

        // return $a[1];

        if($a->count() > 0){
            Session::flash('statuscode','error');
        return redirect('admin/master/matkul')->with('status', 'Gagal Menambahkan Data Matakuliah');
        }else{
        $matkuls = new Matkul;
        
        $b = 'M'.Carbon::now()->format('ymdHi').rand(100,999);

        $matkuls->id = $b;
        $matkuls->kode_vmk = $request->input('kode_vmk');
        $matkuls->nama_matkul = $request->input('nama_matkul');
        $matkuls->sks = $request->input('sks');
        $matkuls->created_at = Carbon::today();

        $matkuls->save();
        
        Session::flash('statuscode','success');
        return redirect('admin/master/matkul')->with('status', 'Berhasil Menambahkan Data Matakuliah');
        }
    }

    public function edit(Request $request, $id)
    {
        $matkuls = Matkul::findOrFail($id);

        return view('admin.matkul.edit', compact('matkuls'));
    }

    public function update(Request $request, $id)
    {

        $this->validate($request,[
            'kode_vmk' => ['required', 'string', 'max:10'],
            'nama_matkul' => ['required', 'string', 'max:255'],
            'sks' => ['required', 'string', 'max:2'],
        ],
        [
            'kode_vmk.required' => 'Kode VMK Wajib Diisi',
            'kode_vmk.max' => 'Kode VMK Terlalu Panjang!',
            'nama_matkul.required' => 'Nama Matkul Wajib Diisi',
            'nama_matkul.max' => 'Nama Matkul Terlalu Panjang!',
            'sks.required' => 'SKS Wajib Diisi',
            'sks.max' => 'SKS Terlalu Panjang!',
        ]);
        
        $matkuls = Matkul::find($id);

        $matkuls->kode_vmk = $request->input('kode_vmk');
        $matkuls->nama_matkul = $request->input('nama_matkul');
        $matkuls->sks = $request->input('sks');
        $matkuls->updated_at = Carbon::now();

        $matkuls->update();

        Session::flash('statuscode','success');
        return redirect('admin/master/matkul')->with('status','Data Matakuliah Berhasil Diubah');
    }

    public function delete($id){

        $matkuls = Matkul::findOrFail($id);
        $matkuls->delete();

        Session::flash('statuscode','success');
        return redirect('admin/master/matkul')->with('status', 'Berhasil Hapus Matakuliah');
        
    }
}
