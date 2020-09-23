<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Praktikum extends Model
{
    protected $table = 'praktikum';
    protected $primaryKey='id';
    public $incrementing = true;

    protected $fillable = [
        'id', 'ruangan_id','dosen_id','matkul_id','jadwal_id', 'semester'
    ];

    public $timestamps = false;

    public function jadwal(){
        return $this->belongsTo(Jadwal::class);
    }

    public function matkul(){
        return $this->belongsTo(Matkul::class);
    }

    public function dosen(){
        return $this->belongsTo(Dosen::class);
    }

    public function ruangan(){
        return $this->belongsTo(Ruangan::class);
    }

    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }

    public function daftar(){
        return $this->belongsTo(Daftar::class);
    }
}
