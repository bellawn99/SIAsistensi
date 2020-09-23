<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Mahasiswa;
use App\User;
use Session;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use File;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class ProfilController extends Controller
{
    
    public function __construct()
  {
      $this->middleware('auth');
  }

    public function index()
    {
        $profils = User::leftJoin('mahasiswa','mahasiswa.user_id','=','user.id')
        ->select('user.email','user.username','mahasiswa.id as mhs_id',
        'mahasiswa.nik','mahasiswa.npwp','mahasiswa.jk','mahasiswa.alamat',
        'mahasiswa.tempat','mahasiswa.nim','mahasiswa.tgl_lahir',
        'mahasiswa.prodi','mahasiswa.khs','mahasiswa.semester', 'mahasiswa.ipk',
        'mahasiswa.nama_bank','mahasiswa.no_rekening','mahasiswa.nama_rekening',
        'user.id','user.nama','user.username','user.password','user.no_hp',
        'user.foto')
        ->where('mahasiswa.user_id',Auth::user()->id)
        ->get();
        
        return view('mahasiswa.profil.profil',compact('profils'));
    }

    public function editFoto(Request $request, $id)
    {

        $users = User::findOrFail($id);
        
        return view('mahasiswa.profil.edit-foto', compact('users'));
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
        // $image = $request->file('foto');

        // $new_name = $users->username . '.' . $image->getClientOriginalExtension();
        // $image->move(public_path('images'), $new_name);
        // if(File::exists($new_name)) {
        //     File::delete($new_name);
        // }
        // $users->foto = $new_name;
        // $users->updated_at = Carbon::now();
        if(empty($users->foto)){
            if ($request->file('foto')) {
                $oldImage = public_path('images/').$users->foto;
                if(File::exists($oldImage)){
                    unlink($oldImage);
                }
                
                $file = $request->file('foto');
                $nama = $users->username . '.' . $file->getClientOriginalExtension();
                $file->move(public_path(). '/images/', $nama);
                $users->foto = $nama;
            }    
        } else {
            if ($request->file('foto')) {
                $file = $request->file('foto');
                $nama = $users->username . '.' . $file->getClientOriginalExtension();
                $file->move(public_path(). '/images/', $nama);
                $users->foto = $file->getClientOriginalName();
            }    
        }

        $users->update();

        Session::flash('statuscode','success');
        return redirect('mahasiswa/profil')->with('status','Avatar berhasil di ubah');
    }

    public function editData(Request $request, $id)
    {

        $users = User::findOrFail($id);
        $mahasiswas = Mahasiswa::all()->where('user_id',$id)->first();
        
        return view('mahasiswa.profil.edit-data',compact('users','mahasiswas'));
    }

    public function updateData(Request $request, $id)
    {

        $this->validate($request,[
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:50'],
            'nim' => ['required', 'string', 'max:20','min:6'],
            'no_hp' => ['required', 'string', 'max:15'],
            'jk' => 'required',
            'nik' => 'required',
            'tempat' => 'required',
            'tgl_lahir' => 'required',
            'alamat' => 'required',
        ],
        [
            'nama.required' => 'Nama Wajib Diisi',
            'nama.max' => 'Nama Terlalu Panjang!',
            'email.required' => 'Email Wajib Diisi',
            'email.max' => 'Email Terlalu Panjang!',
            'nim.required' => 'NIM Wajib Diisi',
            'nim.max' => 'NIM Terlalu Panjang!',
            'nim.min' => 'NIM Terlalu Pendek!',
            'no_hp.required' => 'No HP Wajib Diisi',
            'no_hp.max' => 'No HP Terlalu Panjang!',
            'jk.required' => 'Jenis Kelamin Wajib Diisi',
            'nik.required' => 'NIK Wajib Diisi',
            'tempat.required' => 'Tempat Lahir Wajib Diisi',
            'tgl_lahir.required' => 'Tanggal Lahir Wajib Diisi',
            'alamat.required' => 'Alamat Wajib Diisi',
        ]);

        $users = User::find($id);
        $users = User::where('id',$id)->first();
        $users->nama = $request->input('nama');
        $users->email = $request->input('email');
        $users->no_hp = $request->input('no_hp');

        if($users->update()){
            $mahasiswas = Mahasiswa::find($id);
            $mahasiswas = Mahasiswa::where('user_id',$id)->first();
            $mahasiswas->nim = $request->input('nim');
            $mahasiswas->jk = $request->input('jk');
            $mahasiswas->nik = $request->input('nik');
            $mahasiswas->npwp = $request->input('npwp');
            $mahasiswas->tempat = $request->input('tempat');
            $mahasiswas->tgl_lahir = $request->input('tgl_lahir');
            $mahasiswas->alamat = $request->input('alamat');
            $mahasiswas->updated_at = Carbon::now();
            

            if($mahasiswas->update()){
                $users = User::find($id);
                $users = User::where('id',$id)->first();
                $users->created_at = Carbon::now();
                if(strcmp($request->get('nim'), $request->get('username')) == 0){
                    $users->username = $request->input('nim');
                }else{
                    $users->username = substr ($request->input('nim'), 3, 6);
                }
                $users->update();

                Session::flash('statuscode','success');
                return redirect('mahasiswa/profil')->with('status','Data diri berhasil di ubah');
            }

            
        }else{
            Session::flash('statuscode','error');
            return redirect('mahasiswa/profil')->with('status','Data diri gagal di ubah');
        }
    }

    public function editBank(Request $request, $id)
    {

        $mahasiswas = Mahasiswa::all()->where('user_id',$id)->first();
        
        return view('mahasiswa.profil.edit-bank',compact('mahasiswas'));
    }

    public function updateBank(Request $request, $id)
    {

        $this->validate($request,[
            'nama_bank' => 'required',
            'no_rekening' => 'required',
            'nama_rekening' => 'required',
        ],
        [
            'nama_bank.required' => 'Nama Bank Wajib Diisi',
            'no_rekening.required' => 'No Rekening Wajib Diisi',
            'nama_rekening.required' => 'Nama Rekening Wajib Diisi',
        ]);
        
        $mahasiswas = Mahasiswa::find($id);

        $mahasiswas->nama_bank = $request->nama_bank;
        $mahasiswas->no_rekening = $request->no_rekening;
        $mahasiswas->nama_rekening = $request->nama_rekening;

        $mahasiswas->update();

        Session::flash('statuscode','success');
        return redirect('mahasiswa/profil')->with('status','Data bank berhasil di ubah');
    }

    public function editMahasiswa(Request $request, $id)
    {

        $mahasiswas = Mahasiswa::all()->where('user_id',$id)->first();
        
        return view('mahasiswa.profil.edit-mahasiswa',compact('mahasiswas'));
    }

    public function updateMahasiswa(Request $request, $id)
    {
            $this->validate($request,[
                'prodi' => 'required',
                'ipk' => 'required',
                'khs' => 'required|mimes:pdf',
                'semester' => 'required',
            ],
            [
                'prodi.required' => 'Prodi Wajib Diisi',
                'ipk.required' => 'IPK Wajib Diisi',
                'khs.required' => 'KHS Wajib Diisi',
                'khs.mimes' => 'KHS Harus Berupa File pdf',
                'semester.required' => 'Semester Wajib Diisi',
            ]);

            $mahasiswas = Mahasiswa::find($id);

            $kartu = $request->file('khs');

            $new_name = $mahasiswas->user_id . '.' . $kartu->getClientOriginalExtension();
            $kartu->move(public_path('khs'), $new_name);

            $mahasiswas->prodi = $request->prodi;
            $mahasiswas->khs = $new_name;
            $mahasiswas->ipk = $request->ipk;
            $mahasiswas->semester = $request->semester;

            $mahasiswas->update();

            Session::flash('statuscode','success');
            return redirect('mahasiswa/profil')->with('status','Data mahasiswa berhasil di ubah');
    }

}
