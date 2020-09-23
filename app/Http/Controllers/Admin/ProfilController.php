<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\User;
use Session;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfilController extends Controller
{
    
    public function __construct()
  {
      $this->middleware('auth');
  }

    public function index()
    {
        $profils = User::leftJoin('admin','admin.user_id','=','user.id')
        ->select('user.email','user.username','admin.id as admin_id','admin.nip','user.id','user.nama','user.username','user.password','user.no_hp','user.foto')
        ->where('admin.user_id',Auth::user()->id)
        ->get();
        
        return view('admin.profil.profil',compact('profils'));
    }

    public function editFoto(Request $request, $id)
    {

        $users = User::findOrFail($id);
        
        return view('admin.profil.edit-foto', compact('users'));
    }

    public function updateFoto(Request $request, $id)
    {

        $this->validate($request,[
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],
        [
            'foto.required' => 'Foto Wajib Diisi',
            'foto.mimes' => 'Foto Harus Berupa File: jpeg, png, jpg, atau gif!',
            'foto.max' => 'Ukuran Foto Terlalu Besar!'
        ]);
        
        $users = User::find($id);
        $image = $request->file('foto');

        $new_name = $users->username . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $new_name);
        $users->foto = $new_name;
        $users->updated_at = Carbon::now();

        $users->update();

        Session::flash('statuscode','success');
        return redirect('admin/profil')->with('status','Avatar berhasil di ubah');
    }

    public function editData(Request $request, $id)
    {

        $users = User::findOrFail($id);
        $admins = Admin::all()->where('user_id',$id)->first();
        
        return view('admin.profil.edit-data',compact('users','admins'));
    }

    public function updateData(Request $request, $id)
    {

        $this->validate($request,[
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:50'],
            'nip' => ['required', 'string', 'max:10','min:6'],
            'no_hp' => ['required', 'string', 'max:15'],
        ],
        [
            'nama.required' => 'Nama Wajib Diisi',
            'nama.max' => 'Nama Terlalu Panjang!',
            'email.required' => 'Email Wajib Diisi',
            'email.max' => 'Email Terlalu Panjang!',
            'nip.required' => 'NIP Wajib Diisi',
            'nip.max' => 'NIP Terlalu Panjang!',
            'nip.min' => 'NIP Terlalu Pendek!',
            'no_hp.required' => 'No HP Wajib Diisi',
            'no_hp.max' => 'No HP Terlalu Panjang!',
        ]);

        $users = User::find($id);
        $users = User::where('id',$id)->first();
        $users->nama = $request->input('nama');
        $users->email = $request->input('email');
        $users->no_hp = $request->input('no_hp');

        if($users->update()){
            $admins = Admin::find($id);
            $admins = Admin::where('user_id',$id)->first();
            $admins->nip = $request->input('nip');
            $admin->updated_at = Carbon::now();

            if($admins->update()){
                $users = User::find($id);
                $users = User::where('id',$id)->first();
                $users->updated_at = Carbon::now();
                if(strcmp($request->get('nip'), $request->get('username')) == 0){
                    $users->username = $request->input('nip');
                }else{
                    $users->username = substr ($request->input('nip'), 0, 6);
                }
                $users->update();

                Session::flash('statuscode','success');
                return redirect('admin/profil')->with('status','Data diri berhasil di ubah');
            }
        }

        Session::flash('statuscode','error');
        return redirect('admin/profil')->with('status','Data diri gagal di ubah');
    }

}
