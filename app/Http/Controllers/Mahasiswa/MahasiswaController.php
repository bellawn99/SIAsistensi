<?php

namespace App\Http\Controllers\Mahasiswa;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Mahasiswa;

class MahasiswaController extends Controller
{
    public function index()
    {
        return view('mahasiswa.beranda');
    }
}
