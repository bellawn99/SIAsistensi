<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matkul extends Model
{
    protected $table = 'matkul';
    protected $primaryKey='id';
    public $incrementing = false;
    

    protected $fillable = [
        'id', 'kode_vmk', 'nama_matkul', 'sks',
    ];

    public $timestamps = false;

    protected $casts = ['id' => 'string'];

    public function praktikum(){
        return $this->hasMany(Kelas::class);
    }
}
