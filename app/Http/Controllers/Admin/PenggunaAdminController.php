<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Role;
use App\Admin;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;
use App\Exports\CsvExport;
use App\Imports\AdminImport;
use Maatwebsite\Excel\Facades\Excel;

class PenggunaAdminController extends Controller
{
    public function index()
    {
        $users = Admin::join('user','admin.user_id','=','user.id')
        ->join('role','user.role_id','=','role.id')
        ->select('admin.nip','user.email','user.nama','user.id', 'user.foto',
        'user.no_hp', 'user.role_id', 'user.nama', 'user.username', 'role.role')
        ->distinct()->get();
        return view('admin.pengguna.admin.admin')->with('users',$users);        
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

        Excel::import(new AdminImport, request()->file('file'));
        return back();
    }

    public function store(Request $request){
        $this->validate($request,[
            'nama' => ['required', 'string', 'max:255'],
            'nip' => ['required', 'string', 'max:20','min:6'],
            'password' => ['required', 'string', 'max:255']
        ],
        [
            'nama.required' => 'Nama Wajib Diisi',
            'nama.max' => 'Nama Terlalu Panjang!',
            'nip.required' => 'NIP Wajib Diisi',
            'nip.max' => 'NIP Terlalu Panjang!',
            'nip.min' => 'NIP Terlalu Pendek!',
            'password.required' => 'Password Wajib Diisi',
            'password.max' => 'Password Terlalu Panjang!',
        ]);    
        

        
        
        $a = Role::select('id')->where('role','admin')->first();
        $b = Carbon::now()->format('ymd').rand(1000,9999);

        $admins = new Admin;
        $ad = 'A'.Carbon::now()->format('ymdHi').rand(100,999);
        $admins->id = $ad;
        

        $users = new User;
        $users->id = $b;
        $users->role_id = $a->id;
        $users->email = $request->input('email');
        $users->nama = $request->input('nama');
        $users->created_at = Carbon::now();
        $admins->created_at = Carbon::now();
       

        $admins->user_id = $b;
        $admins->nip = $request->input('nip'); 
        

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

        if(strcmp($request->get('nip'), $request->get('username')) == 0){
            $users->username = $request->input('nip');
        }else{
            $users->username = substr ($request->input('nip'), 0, 6);
        }        
            $users->save();
            $admins->save();
        
        Session::flash('statuscode','success');
        return redirect('admin/pengguna/user-admin')->with('status', 'Berhasil Menambahkan Data Admin');
    }

    public function reset(Request $request,$id=0){

        $id = $request->id;
               
        $users = User::find($id);
        $users = User::where('id',$id)->first();

        if($id == Auth()->user()->id){
            Session::flash('statuscode','error');
            return redirect('admin/pengguna/user-admin')->with('status','Tidak dapat reset password diri sendiri!');
        }
        else{

        $users->password = Hash::make($request->get('username'));
        $users->save();
        
        Session::flash('statuscode','success');
        return redirect('admin/pengguna/user-admin')->with('status', 'Berhasil Reset Password Admin');
        }
    }

    public function delete($id)
    {
        $users = User::findOrFail($id);

        if($id == Auth()->user()->id){
            Session::flash('statuscode','error');
            return redirect('admin/pengguna/user-admin')->with('status','Tidak dapat reset password diri sendiri!');
        }else{
        $admins = User::where('id', $users->id)->get();
        foreach ($admins as $admin) {
            Admin::where('user_id', $admin->id)->delete();
        }

        User::where('id', $users->id)->delete();

        Session::flash('statuscode','success');
        return redirect('admin/pengguna/user-admin')->with('status', 'Berhasil Hapus Admin');
    }
    }
}
