<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admin';
    protected $primaryKey='id';
    public $incrementing = false;

    protected $fillable = [
        'id', 'nip', 'user_id'
    ];

    protected $casts = ['id' => 'string'];

    public $timestamps = false;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function berita(){
        return $this->hasMany(Berita::class);
    }
}
