<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey='id';
    public $incrementing = false;

    protected $fillable = [
        'id', 'nim','user_id', 'nik','npwp','jk','tempat','tgl_lahir','alamat','prodi','khs','ipk','semester','nama_bank','no_rekening','nama_rekening'
    ];

    protected $casts = ['id' => 'string'];

    public $timestamps = false;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function daftar(){
        return $this->hasMany(Daftar::class);
    }
}
