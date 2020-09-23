<?php

namespace App\Http\Controllers\Superadmin;

use App\User;
use App\Role;
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
use App\Imports\CsvImport;
use Maatwebsite\Excel\Facades\Excel;

class DataUserController extends Controller
{
    public function index()
    {
        $users = User::join('role','user.role_id','=','role.id')
        ->select('user.id', 'user.foto', 'user.no_hp', 'user.role_id', 'user.nama', 'user.username', 'role.role')
        ->distinct()->get();
        return view('superadmin.user.user')->with('users',$users);        
        // return $users;
        
    }

    // public function show($id)
    // {
    //     $users = User::findOrFail($id);
    //     $roles = Role::all();
    //     return view('admin.showuser', compact('users','roles'));
    // }

    public function csv_import()
    {
        Excel::import(new CsvImport, request()->file('file'));
        Session::flash('statuscode','success');
            return redirect('superadmin/master/user')->with('status','Berhasil menambahkan data user!');
    }

    // public function getdata(){
    //     $users = User::select('users.*');
    //     \DataTables::eloquent($users)->toJson();
    // }

    public function edituser(Request $request, $id)
    {

        if($id == Auth()->user()->id){
            Session::flash('statuscode','error');
            return redirect('superadmin/master/user')->with('status','Tidak dapat mengubah diri sendiri!');
        }
        else{

        $users = User::findOrFail($id);
        // $roles = DB::table('roles')->select('id','role')->get()->toArray();



        
        // for($i = 0; $i >=1; $i++){
        // $data = $roles[$i]->role;
        // }
        // $data = $roles[$i]->role;
        
        // foreach($roles as $a){
        //     foreach($a as $data){
        //         $a = $data;
        //     }
        // }
        // dd($data);
        return view('superadmin.user.edituser', compact('users'));
        }
    }

    public function updateuser(Request $request, $id)
    {

        $this->validate($request,[
            'nama' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:10'],
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'role_id' => 'required',
        ]);
        
        $users = User::find($id);
        $image = $request->file('foto');

        $new_name = $users->username . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $new_name);
        $users->nama = $request->input('nama');
        $users->username = $request->input('username');
        $users->no_hp = $request->input('no_hp');
        $users->foto = $new_name;
        $users->role_id = $request->input('role_id');

        $users->update();

        Session::flash('statuscode','success');
        return redirect('superadmin/master/user')->with('status','Data User berhasil di ubah');
    }

    public function store(Request $request){
        $this->validate($request,[
            'nama' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:10'],
            'password' => ['required', 'string', 'max:255'],
            'role_id' => 'required',
        ]);

    
        
        

        $users = new User;
        
        $b = Carbon::now()->format('ymd').rand(1000,9999);
        $image = $request->file('foto');

        $new_name = $users->username . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $new_name);
        $users->id = $b;
        $users->role_id = $request->input('role_id');
        $users->nama = $request->input('nama');
        $users->username = $request->input('username');
        $users->password = Hash::make($request->input('password'));
        $users->no_hp = $request->input('no_hp');
        if($users->foto==''){
            $users->foto = 'avatar.png';
        }else{
            $users->foto = $new_name;
        }

        $users->save();
        
        Session::flash('statuscode','success');
        return redirect('superadmin/master/user')->with('status', 'Berhasil Menambahkan Data User');
    }

    public function delete($id){

        if($id == Auth()->user()->id){
            Session::flash('statuscode','error');
            return redirect('superadmin/master/user')->with('status','Tidak dapat menghapus diri sendiri!');
        }
        else{
        $users = User::findOrFail($id);
        $users->delete();

        Session::flash('statuscode','success');
        return redirect('superadmin/master/user')->with('status', 'Berhasil Hapus User');
        }
    }
}
