<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    protected $table = 'kontak';
    protected $primaryKey='id';

    protected $fillable = [
        'id', 'nama', 'email', 'no_hp', 'pesan'
    ];


    public $timestamps = false;
}
