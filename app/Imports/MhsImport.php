<?php

namespace App\Imports;

use App\User;
use App\Mahasiswa;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Role;
use Carbon\Carbon;
use Session;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class MhsImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    // public function model(array $row)
    // {
    //     $a = Role::select('id')->where('role','mahasiswa')->get()->first()->toArray();
    //     $b = Carbon::now()->format('ymd').rand(1000,9999);
    //     return new User([
           

    //         'id' => $b,
    //         'role_id' => $a['id'],
    //         'nama' =>  $row[0],
    //         'username' =>  $row[1],
    //         'password' => \Hash::make( array_get($row, 'niu')),
    //     ]);
    // }

    public function collection(Collection $collection){
		$total_data=0;
		$berhasil=0;
		$gagal=0;


        $rules = ['0' => 'string'];

        $pesan = ['0' => 'Nama Harus String'];

        foreach($collection as $key => $row){
            if($key>=1){
                $validator = \Validator::make($row->toArray(),$rules,$pesan);
                if($validator->fails()){ $gagal++; continue; }
                if(User::where(['nama'=>$row[0],'username'=>substr ($row[1], 3, 6)])->exists()){
                    $gagal++;
                }
				else{
                    $a = Role::select('id')->where('role','admin')->get()->first()->toArray();
					$b = Carbon::now()->format('ymd').rand(1000,9999);
                    $c = 'M'.Carbon::now()->format('ymdHi').rand(100,999);
                    User::create([
                        'id' => $b,
                        'role' => $a->id,
                        'nama' =>  $row[0],
                        'username' =>  substr ($row[1], 3, 6),
                        'password' => \Hash::make(substr ($row[1], 3, 6)),
                    ]);
                    Mahasiswa::create([
                        'id' => $c,
                        'user_id' => $b,
                        'nim' => $row[1]
                    ]);
					$berhasil++;
                }
				$total_data++;
            }
        }
        if($berhasil==0 && $gagal>0){
            Session::flash('statuscode','error');
            return redirect('admin/pengguna/user-mahasiswa')->with('status', "Gagal menambahkan ".$gagal." data"); 
        }elseif($gagal>0 && $berhasil>0){
            Session::flash('statuscode','error');
            return redirect('admin/pengguna/user-mahasiswa')->with('status', "Berhasil menambahkan ".$berhasil." data. Gagal menambahkan ".$gagal." data"); 
        }elseif($gagal==0 && $berhasil>0){
            Session::flash('statuscode','success');
            return redirect('admin/pengguna/user-mahasiswa')->with('status', "Berhasil menambahkan ".$berhasil." data");
        }
		// $status = "Dari Total Data: ".$total_data." Data berhasil ditambahkan: ".$berhasil." Data gagal ditambahkan: ".$gagal;
        
        
    }
}
