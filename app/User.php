<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;


    protected $table = 'user';
    protected $primaryKey='id';
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'email', 'nama', 'username', 'password', 'role_id', 'no_hp', 'foto',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function isAdmin()
    {
        if($this->role_id == 1)return true;
            return false;
    }

    public function isMhs()
    {
        if($this->role_id == 2)return true;
            return false;
    }

    public function isSuper()
    {
        if($this->role_id == 3)return true;
            return false;
    }

    public function mahasiswa(){
        return $this->belongsTo(Mahasiswa::class);
    }

    public function admin(){
        return $this->belongsTo(Admin::class);
    }
}
