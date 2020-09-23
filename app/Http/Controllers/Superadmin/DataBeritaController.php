<?php

namespace App\Http\Controllers\Superadmin;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Berita;
use App\User;
use App\Admin;
use Auth;
use Carbon\Carbon;
use Session;
use Maatwebsite\Excel\Facades\Excel;

class DataBeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::all();
        return view('superadmin.berita.berita',compact('beritas'));        
    }

    public function store(Request $request){
        $this->validate($request,[
            'judul' => 'required',
            'isi' => 'required',
            'foto' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],
        [
            'judul.required' => 'Judul Wajib Diisi',
            'isi.required' => 'Isi Wajib Diisi',
            'foto.required' => 'Foto Wajib Diisi',
            'foto.mimes' => 'Foto Harus Berupa File: jpeg, png, jpg, atau gif!',
        ]);

        // return $request->foto;

        $a = Berita::where(['judul'=>$request->judul,'isi'=>$request->isi,'foto'=>$request->foto])->get();

        if(count($a)>0){
            Session::flash('statuscode','error');
            return redirect('superadmin/berita')->with('status', 'Gagal Menambahkan Data Berita');
        }else{
        $now = Carbon::now();
        $id = 'B'.Carbon::now()->format('ymdHi').rand(100,999);

        $a = Admin::where('user_id',Auth::user()->id)->first();

        $beritas = new Berita;

        $image = $request->file('foto');

        $new_name = $id . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('landing/images'), $new_name);
        $beritas->id = $id;
        $beritas->admin_id = $a->id;
        $beritas->judul = $request->input('judul');
        $beritas->isi = nl2br($request->input('isi'));
        $beritas->foto = $new_name;
        $beritas->created_at = $now;

        $beritas->save();
        
        Session::flash('statuscode','success');
        return redirect('superadmin/berita')->with('status', 'Berhasil Menambahkan Data Berita');
        }
    }

    public function edit(Request $request, $id)
    {
        $beritas = Berita::findOrFail($id);

        return view('superadmin.berita.edit', compact('beritas'));
    }

    public function update(Request $request, $id)
    {

        $this->validate($request,[
            'judul' => 'required',
            'isi' => 'required',
            'foto' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],
        [
            'judul.required' => 'Judul Wajib Diisi',
            'isi.required' => 'Isi Wajib Diisi',
            'foto.required' => 'Foto Wajib Diisi',
            'foto.mimes' => 'Foto Harus Berupa File: jpeg, png, jpg, atau gif!',
        ]);
        
        $beritas = Berita::find($id);
        $now = Carbon::now();

        $image = $request->file('foto');

        $new_name = $beritas->id . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('landing/images'), $new_name);
        $beritas->judul = $request->input('judul');
        $beritas->isi = nl2br($request->input('isi'));
        $beritas->foto = $new_name;
        $beritas->created_at = $now;

        $beritas->update();

        Session::flash('statuscode','success');
        return redirect('superadmin/berita')->with('status','Data Berita Berhasil Diubah');
    }

    public function delete($id){

        $beritas = Berita::findOrFail($id);
        $beritas->delete();

        Session::flash('statuscode','success');
        return redirect('superadmin/berita')->with('status', 'Berhasil Hapus Berita');
        
    }
}
