<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwal';
    public $incrementing = false;
    protected $primaryKey='id';

    protected $fillable = [
        'id', 'hari', 'jam_mulai', 'jam_akhir',
    ];

    protected $casts = ['id' => 'string'];

    public $timestamps = false;

    public function praktikum(){
        return $this->hasMany(Kelas::class);
    }
}
