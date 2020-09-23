<?php

namespace App\Http\Controllers\Superadmin;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ketentuan;
use Carbon\Carbon;
use Session;
use Maatwebsite\Excel\Facades\Excel;

class DataKetentuanController extends Controller
{
    public function index()
    {
        $ketentuans = Ketentuan::all();
        return view('superadmin.ketentuan.ketentuan',compact('ketentuans'));        
    }

    public function store(Request $request){
        $this->validate($request,[
            'ketentuan' => 'required',
        ],
        [
            'ketentuan.required' => 'Ketentuan Wajib Diisi'
        ]);

    
        
        $a = Ketentuan::where(['ketentuan'=>$request->ketentuan])->get();

        if(count($a)>0){
            Session::flash('statuscode','error');
            return redirect('superadmin/ketentuan')->with('status', 'Gagal Menambahkan Data Ketentuan');
        }else{
            $ketentuans = new Ketentuan;

            $ketentuans->ketentuan = $request->input('ketentuan');
            $ketentuans->created_at = Carbon::now();
    
            $ketentuans->save();
            
            Session::flash('statuscode','success');
            return redirect('superadmin/ketentuan')->with('status', 'Berhasil Menambahkan Data Ketentuan');
        }
    }

    public function edit(Request $request, $id)
    {
        $ketentuans = Ketentuan::findOrFail($id);

        return view('superadmin.ketentuan.edit', compact('ketentuans'));
    }

    public function update(Request $request, $id)
    {

        $this->validate($request,[
            'ketentuan' => 'required',
        ],
        [
            'ketentuan.required' => 'Nama Wajib Diisi'
        ]);
        
        $ketentuans = Ketentuan::find($id);

        $ketentuans->ketentuan = $request->input('ketentuan');
        $ketentuans->updated_at = Carbon::now();

        $ketentuans->update();

        Session::flash('statuscode','success');
        return redirect('superadmin/ketentuan')->with('status','Data Ketentuan Berhasil Diubah');
    }

    public function delete($id){

        $ketentuans = Ketentuan::findOrFail($id);
        $ketentuans->delete();

        Session::flash('statuscode','success');
        return redirect('superadmin/ketentuan')->with('status', 'Berhasil Hapus Ketentuan');
        
    }
}
