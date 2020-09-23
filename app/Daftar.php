<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Daftar extends Model
{
    protected $table = 'daftar';
    protected $primaryKey='id';
    public $incrementing = false;

    protected $fillable = [
        'id', 'mahasiswa_id','praktikum_id','status'
    ];

    public $timestamps = false;

    protected $casts = ['id' => 'string'];

    public function praktikum(){
        return $this->belongsTo(Praktikum::class);
    }

    public function mahasiswa(){
        return $this->belongsTo(Mahasiswa::class);
    }
}
