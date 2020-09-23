<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $primaryKey='id';
    public $incrementing = false;

    protected $fillable = [
        'id', 'nama'
    ];

    protected $casts = ['id' => 'string'];

    public $timestamps = false;

    public function praktikum(){
        return $this->hasMany(Jadwal::class);
    }
}
