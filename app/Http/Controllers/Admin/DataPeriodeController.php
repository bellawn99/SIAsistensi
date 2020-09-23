<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Periode;
use App\Berita;
use App\Admin;
use App\User;
use Notification;
use App\Notifications;
use App\Notifications\Pengumuman;
use Auth;
use Carbon\Carbon;
use Session;

class DataPeriodeController extends Controller
{
    public function index()
    {
        $periodes = Periode::all();
        $beritas = Berita::all();
       return view('admin.periode.periode',compact('periodes','beritas'));     
    }

    public function store(Request $request){
        $this->validate($request,[
            'tgl_mulai' => 'required',
            'thn_ajaran' => 'required',
            'status' => 'required',
            'semester' => 'required'
        ],
        [
            'tgl_mulai.required' => 'Tanggal Mulai Wajib Diisi',
            'thn_ajaran.required' => 'Tahun Ajaran Wajib Diisi',
            'status.required' => 'Status Wajib Diisi',
            'semester.required' => 'Semester Wajib Diisi',
        ]);

        // $periodes = new Periode;
        
        $b = 'P'.Carbon::now()->format('ymdHi').rand(100,999);

        $a = Periode::where(['tgl_mulai'=>$request->tgl_mulai,'thn_ajaran'=>$request->thn_ajaran,'status'=>$request->status,'semester'=>$request->semester])->get();

        if(count($a)>0){
            Session::flash('statuscode','error');
            return redirect('admin/periode')->with('status', 'Gagal Menambahkan Data Periode');
        }else{
        if($request->get('status')=='Daftar'){
            $beritas = new Berita;
            $beritas->id = 'B'.Carbon::now()->format('ymdHi').rand(100,999);
            $admin = Admin::where('user_id',Auth::user()->id)->first();
            $beritas->admin_id = $admin->id;
            $judul = "Pendaftaran Asistensi Semester ".$request->input('semester')." TA ".$request->input('thn_ajaran');
            $isi = "PERSIAPKAN DIRIMU !
            
Kami dari Admin Asistensi menyelenggarakan Open Recruitment Asisten Praktikum Semester Genap Tahun Akademik 2020/2021.
                        
Catat tanggalnya :
Pendaftaran : ".$request->input('tgl_mulai')."-".$request->input('tgl_selesai')."
                        
Informasi lebih lanjut
CP : 088-888-888-888
Daftarkan segera dan jadilah bagian dari kami.";
            $count = Berita::where('judul',$judul)->get()->count();
            if($count < 1){
            $beritas->judul = $judul;
            $beritas->isi = $isi;
            $beritas->foto = "daftar.png";
            $beritas->created_at = Carbon::now();
            if($beritas->save()){
                $periodes = new Periode;
        
              $periodes->id = $b;
              $periodes->berita_id = $beritas->id;
              $periodes->tgl_mulai = $request->input('tgl_mulai');
              $periodes->tgl_selesai = $request->input('tgl_selesai');
              $periodes->thn_ajaran = $request->input('thn_ajaran');
              $periodes->status = $request->input('status');
              $periodes->semester = $request->input('semester');
              $periodes->created_at = Carbon::now();
                if($periodes->save()){
                    $beritas->save();
                }
                
            }
            }else{
                Session::flash('statuscode','error');
                return redirect('admin/periode')->with('status', 'Gagal Menambahkan Data Periode!'); 
            }
      }else{
            $beritas = new Berita;
            $beritas->id = 'B'.Carbon::now()->format('ymdHi').rand(100,999);
            $admin = Admin::where('user_id',Auth::user()->id)->first();
            $beritas->admin_id = $admin->id;
            $judul2 = "Pengumuman Penerimaan Asisten Praktikum Semester ".$request->input('semester')." TA ".$request->input('thn_ajaran');
            $isi2 = "Assalamualaikum Wr Wb
Salam sejahtera bagi kita semua.
            
Kami dari Admin Asistensi memberitahukan kepada seluruh calon Asisten Praktikum Semester Genap Tahun Akademik".$request->input('thn_ajaran').", ingin menginformasikan bahwa sudah ada daftar nama Asisten Praktikum Tahun Ajaran ini. Untuk lebih lengkapnya silahkan login dengan akun masing-masing.";
            $count = Berita::where('judul',$judul2)->get()->count();
            if($count < 1){
            $beritas->judul = $judul2;
            $beritas->isi = $isi2;
            $beritas->foto = "terima.png";
            $beritas->created_at = Carbon::now();
            if($beritas->save()){
                $periodes = new Periode;
        
              $periodes->id = $b;
              $periodes->berita_id = $beritas->id;
              $periodes->tgl_mulai = $request->input('tgl_mulai');
              $periodes->tgl_selesai = $request->input('tgl_selesai');
              $periodes->thn_ajaran = $request->input('thn_ajaran');
              $periodes->status = $request->input('status');
              $periodes->semester = $request->input('semester');
              $periodes->created_at = Carbon::now();
                if($periodes->save()){
                    $beritas->save();
                }
                    
                } 
            }else{
                Session::flash('statuscode','error');
                return redirect('admin/periode')->with('status', 'Gagal Menambahkan Data Periode!'); 
            }
    
            $user = User::where('role_id',2)->select('id','role_id','nama','email')->get();
            
            $collection = [];
    
            foreach($user as $iki){
                $collection[] = $iki;
            }
    
            $details = [
                'greeting' => 'Hallo!',
                'body' => 'Kami ingin memberitahukan bahwa data nama asistensi sudah dapat diakses di akun masing-masing',
                'thanks' => 'Terimakasih',
                'actionText' => 'Cek Pengumuman',
                'actionURL' => url('/login'),
                'id' => $periodes->created_at
            ];
    
            Notification::send($collection, new Pengumuman($details));
            
      } 
    Session::flash('statuscode','success');
        return redirect('admin/periode')->with('status', 'Berhasil Menambahkan Data Periode');
    }
    }

    public function edit(Request $request, $id)
    {
        $periodes = Periode::where('berita_id','=',$id)->firstOrFail();
        
        return view('admin.periode.edit', compact('periodes'));
    }

    public function update(Request $request, $id)
    {

        $this->validate($request,[
            'tgl_mulai' => 'required',
            'thn_ajaran' => 'required',
            'status' => 'required',
            'semester' => 'required'            
        ],
        [
            'tgl_mulai.required' => 'Tanggal Mulai Wajib Diisi',
            'thn_ajaran.required' => 'Tahun Ajaran Wajib Diisi',
            'status.required' => 'Status Wajib Diisi',
            'semester.required' => 'Semester Wajib Diisi',
        ]);
        
        
        if($request->get('status') == "Daftar"){
        $judul = "Pendaftaran Asistensi Semester ".$request->input('semester')." TA ".$request->input('thn_ajaran');
        $isi = "PERSIAPKAN DIRIMU !
            
Kami dari Admin Asistensi menyelenggarakan Open Recruitment Asisten Praktikum Semester Genap Tahun Akademik 2020/2021.
                        
Catat tanggalnya :
Pendaftaran : ".$request->input('tgl_mulai')."-".$request->input('tgl_selesai')."
                        
Informasi lebih lanjut
CP : 088-888-888-888
Daftarkan segera dan jadilah bagian dari kami.";
        
        $beritas = Berita::where('id','=',$id)->first();
        $admin = Admin::where('user_id',Auth::user()->id)->first();
        if($beritas->judul != $judul || $beritas->judul == $judul){
            $beritas->admin_id = $admin->id;
            $beritas->judul = $judul;
            $beritas->isi = $isi;
            $beritas->foto = "daftar.png";
            $beritas->created_at = Carbon::now();
            if($beritas->update()){
                $periodes = Periode::where('berita_id','=',$id)->firstOrFail();
        

                $periodes->tgl_mulai = $request->input('tgl_mulai');
                $periodes->tgl_selesai = $request->input('tgl_selesai');
                $periodes->thn_ajaran = $request->input('thn_ajaran');
                $periodes->status = $request->input('status');
                $periodes->semester = $request->input('semester');
                if($periodes->update()){
                    $beritas->update();
                }
                
            } 
        }else{
            Session::flash('statuscode','error');
            return redirect('admin/periode')->with('status', 'Gagal Merubah Data Periode!'); 
        }
              

        }elseif($request->get('status') == "Pengumuman"){
            $judul2 = "Pengumuman Penerimaan Asisten Praktikum Semester ".$request->input('semester')." TA ".$request->input('thn_ajaran');
            $isi2 = "Assalamualaikum Wr Wb
Salam sejahtera bagi kita semua.
            
Kami dari Admin Asistensi memberitahukan kepada seluruh calon Asisten Praktikum Semester Genap Tahun Akademik".$request->input('thn_ajaran').", ingin menginformasikan bahwa sudah ada daftar nama Asisten Praktikum Tahun Ajaran ini. Untuk lebih lengkapnya silahkan login dengan akun masing-masing.";
            
            $beritas = Berita::where('id','=',$id)->first();
            $admin = Admin::where('user_id',Auth::user()->id)->first();
            if($beritas->judul != $judul2 || $beritas->judul == $judul2){
                $beritas->admin_id = $admin->id;
                $beritas->judul = $judul2;
                $beritas->isi = $isi2;
                $beritas->foto = "daftar.png";
                $beritas->created_at = Carbon::now();
                if($beritas->update()){
                    $periodes = Periode::where('berita_id','=',$id)->firstOrFail();
            
    
                    $periodes->tgl_mulai = $request->input('tgl_mulai');
                    $periodes->thn_ajaran = $request->input('thn_ajaran');
                    $periodes->status = $request->input('status');
                    $periodes->semester = $request->input('semester');
                    if($periodes->update()){
                        $beritas->update();
                    }
                    
                } 
            }else{
                Session::flash('statuscode','error');
                return redirect('admin/periode')->with('status', 'Gagal Merubah Data Periode!'); 
            }
        }
        

        Session::flash('statuscode','success');
        return redirect('admin/periode')->with('status','Data Periode Berhasil Diubah');
    }

    public function delete($id){

        $periodes = Periode::where('berita_id',$id);
        $periodes->delete();
        $beritas = Berita::where('id',$id);
        $beritas->delete();        

        Session::flash('statuscode','success');
        return redirect('admin/periode')->with('status', 'Berhasil Hapus Periode');
        
    }

}
