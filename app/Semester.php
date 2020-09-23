<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $table = 'semester';
    protected $primaryKey='id';
    public $incrementing = false;

    protected $fillable = [
        'id', 'semester',
    ];

    protected $casts = ['id' => 'string'];

    public $timestamps = false;

    public function praktikum(){
        return $this->belongsTo(Kelas::class);
    }
}
