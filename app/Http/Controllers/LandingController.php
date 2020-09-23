<?php

namespace App\Http\Controllers;

use App\User;
use App\Kontak;
use App\Ketentuan;
use App\Berita;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;

class LandingController extends Controller
{

    public function index()
    {

        $user = Auth::user(); 
        if(! $user){
            $ketentuans = Ketentuan::all();
            $berita = Berita::all();
            return view('landing')->with('ketentuans',$ketentuans)->with('berita',$berita);  
        }elseif($user->role_id == 1){
            return redirect()->route('admin.dashboard');
        }else{
            return redirect()->route('mahasiswa.beranda'); 
            
        }

    }

    public function saveContact(Request $request) { 

        $this->validate($request, [
            'nama' => 'required',
            'email' => 'required|email',
            'pesan' => 'required'
        ]);

        $kontaks = new Kontak;

        $kontaks->nama = $request->nama;
        $kontaks->email = $request->email;
        $kontaks->no_hp = $request->no_hp;
        $kontaks->pesan = $request->pesan;

        $kontaks->save();

        \Mail::send('contact-view',
             array(
                 'nama' => $request->get('nama'),
                 'email' => $request->get('email'),
                 'no_hp' => $request->get('no_hp'),
                 'pesan' => $request->get('pesan'),
             ), function($message) use ($request)
               {
                  $message->from($request->email);
                  $message->to('asistensikomsi@gmail.com');
               });

        
        Session::flash('statuscode','success');
        return back()->with('status', 'Terimakasih sudah menghubungi kami!');

    }

    public function berita(Request $request, $id){
        $berita = Berita::findOrFail($id);
        $nama = $berita::join('admin','berita.admin_id','=','admin.id')
        ->join('user','admin.user_id','=','user.id')
        ->first();
        $lain = Berita::where('id','!=',$id)->get();
        return view('berita', compact('berita','lain','nama'));
    }
}
