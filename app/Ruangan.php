<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    protected $table = 'ruangan';
    public $incrementing = false;
    protected $primaryKey='id';

    protected $fillable = [
        'id', 'nama_ruangan',
    ];

    protected $casts = ['id' => 'string'];

    public $timestamps = false;

    public function praktikum(){
        return $this->hasMany(Kelas::class);
    }
}
