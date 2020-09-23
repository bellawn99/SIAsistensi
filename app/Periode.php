<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    protected $table = 'periode';
    protected $primaryKey='id';
    public $incrementing = false;

    protected $fillable = [
        'id', 'tgl_mulai', 'tgl_selesai', 'thn_ajaran'
    ];

    protected $casts = ['id' => 'string'];

    public $timestamps = false;

    public function berita(){
        return $this->belongsTo(Berita::class);
    }
}
