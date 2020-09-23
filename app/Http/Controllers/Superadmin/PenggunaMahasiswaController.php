<?php

namespace App\Http\Controllers\Superadmin;

use App\User;
use App\Role;
use App\Mahasiswa;
use App\Daftar;
use App\Praktikum;
use App\Matkul;
use App\Dosen;
use App\Kelas;
use App\Jadwal;
use App\Ruangan;
use App\Periode;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;
use App\Imports\MhsImport;
use Maatwebsite\Excel\Facades\Excel;

class PenggunaMahasiswaController extends Controller
{
    public function index()
    {
        $users = Mahasiswa::join('user','mahasiswa.user_id','=','user.id')
        ->join('role','user.role_id','=','role.id')
        ->select('mahasiswa.*','user.email','user.nama','user.id', 'user.foto', 'user.no_hp', 'user.role_id', 'user.nama', 'user.username', 'role.role')
        ->distinct()->get();
        return view('superadmin.pengguna.mahasiswa.mahasiswa')->with('users',$users);        
        // return $users;
        
    }

    public function show($id)
    {
        $users = Mahasiswa::join('user','mahasiswa.user_id','=','user.id')
        ->join('role','user.role_id','=','role.id')
        ->where('user.id','=',$id)
        ->select('mahasiswa.*','user.email','user.nama','user.id', 'user.foto', 'user.no_hp', 'user.role_id', 'user.nama', 'user.username', 'role.role')
        ->distinct()->get();

        $asistensi = Daftar::leftJoin('mahasiswa','daftar.mahasiswa_id','=','mahasiswa.id')
        ->leftJoin('user','mahasiswa.user_id','=','user.id')
        ->leftJoin('praktikum','daftar.praktikum_id','=','praktikum.id')
        ->leftJoin('dosen','praktikum.dosen_id','=','dosen.id')
        ->leftJoin('matkul','praktikum.matkul_id','=','matkul.id')
        ->leftJoin('jadwal','praktikum.jadwal_id','=','jadwal.id')
        ->leftJoin('ruangan','praktikum.ruangan_id','=','ruangan.id')
        ->leftJoin('periode','daftar.periode_id','=','periode.id')
        ->join('kelas','praktikum.kelas_id','=','kelas.id')
        ->where('user.id','=',$id)
        ->select('periode.thn_ajaran','daftar.praktikum_id as praktikum','daftar.id as noDaftar','user.nama as user','praktikum.semester','mahasiswa.khs',
        'mahasiswa.id as id','mahasiswa.ipk','daftar.status','kelas.nama','jadwal.hari','jadwal.jam_mulai',
        'jadwal.jam_akhir','matkul.nama_matkul','dosen.nama as nama_dosen','ruangan.nama_ruangan')
        ->get();  

        return view('superadmin.pengguna.mahasiswa.detail')->with('users',$users)->with('asistensi',$asistensi);        
        // return $users;
        
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

        Excel::import(new MhsImport, request()->file('file'));
        return back();
    }

    public function store(Request $request){
        $this->validate($request,[
            'nama' => ['required', 'string', 'max:255'],
            'nim' => ['required', 'string', 'max:20','min:6'],
            'password' => ['required', 'string', 'max:255']
        ],
        [
            'nama.required' => 'Nama Wajib Diisi',
            'nama.max' => 'Nama Terlalu Panjang!',
            'nim.required' => 'NIM Wajib Diisi',
            'nim.max' => 'NIM Terlalu Panjang!',
            'nim.min' => 'NIM Terlalu Pendek!',
            'password.required' => 'Password Wajib Diisi',
            'password.max' => 'Password Terlalu Panjang!',
        ]);    
        

        
        
        $a = Role::select('id')->where('role','mahasiswa')->first();
        $b = Carbon::now()->format('ymd').rand(1000,9999);

        $mahasiswas = new Mahasiswa;
        $ad = 'M'.Carbon::now()->format('ymdHi').rand(100,999);
        $mahasiswas->id = $ad;
        

        $users = new User;
        $users->id = $b;
        $users->role_id = $a->id;
        $users->nama = $request->input('nama');
        $users->email = $request->input('email');
        $users->created_at = Carbon::now();
        $mahasiswas->created_at = Carbon::now();
       

        $mahasiswas->user_id = $b;
        $mahasiswas->nim = $request->input('nim'); 
        

        if($request->hasFile('foto')){
            $image = $request->file('foto');

            $new_name = $users->username . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $new_name);

            $users->foto = $new_name;
            
        }else{
            $users->foto = 'avatar.png';
        }

        $users->password = Hash::make($request->input('password'));
        
        if($request->hasFile('no_hp')){
            $users->no_hp = $request->input('no_hp');
        }else{
            $users->no_hp = null;
        }

        if(strcmp($request->get('nim'), $request->get('username')) == 0){
            $users->username = $request->input('nim');
        }else{
            $users->username = substr ($request->input('nim'), 3, 6);
        }        
            $users->save();
            $mahasiswas->save();
        
        Session::flash('statuscode','success');
        return redirect('superadmin/pengguna/user-mahasiswa')->with('status', 'Berhasil Menambahkan Data Mahasiswa');
    }

    public function reset(Request $request,$id=0){

        $id = $request->id;
               
        $users = User::find($id);
        $users = User::where('id',$id)->first();

        $users->password = Hash::make($request->get('username'));
        $users->save();
        
        Session::flash('statuscode','success');
        return redirect('superadmin/pengguna/user-mahasiswa')->with('status', 'Berhasil Reset Password Mahasiswa');
    }

    public function delete($id)
    {
        $users = User::findOrFail($id);

        $mahasiswas = User::where('id', $users->id)->get();
        foreach ($mahasiswas as $mahasiswa) {
            Mahasiswa::where('user_id', $mahasiswa->id)->delete();
        }

        User::where('id', $users->id)->delete();

        Session::flash('statuscode','success');
        return redirect('superadmin/pengguna/user-mahasiswa')->with('status', 'Berhasil Hapus Mahasiswa');
    }

}