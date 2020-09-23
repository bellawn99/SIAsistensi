<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = 'dosen';
    protected $primaryKey='id';
    public $incrementing = false;

    protected $fillable = [
        'id', 'nidn', 'nama'
    ];

    protected $casts = ['id' => 'string'];

    public $timestamps = false;

    public function praktikum(){
        return $this->hasMany(Kelas::class);
    }
}
