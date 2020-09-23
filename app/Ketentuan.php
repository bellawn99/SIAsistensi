<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ketentuan extends Model
{
    protected $table = 'ketentuan';

    protected $fillable = [
        'id', 'ketentuan'
    ];
    
    public $timestamps = false;
}
