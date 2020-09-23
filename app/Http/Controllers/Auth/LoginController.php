<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests;
use App\Mahasiswa;
use App\Admin;
use App\User;
use Carbon\Carbon;
use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    

    protected $redirectTo = '/login';

   // protected $username = 'username';

   //MODIFIKASI LOGIN REQUEST MANUAL, JIKA SUDAH LOGIN diredirect ke halaman yang dituju sesuai role
	public function login(Request $request){
		$this->validate($request, [
			'username' => 'required',
			'password' => 'required',
			]);
		$auth = Auth::attempt(['username' => $request->username,'password' => $request->password]);
		if($auth){
			if(Auth::user()->isAdmin()){
               return redirect('/admin/dashboard');
            }
            else if(Auth::user()->isMhs()){
               return redirect('/mahasiswa/dashboard');
            }else if(Auth::user()->isSuper()){
                return redirect('/superadmin/dashboard');
            }
		}else{
			return redirect('/login')->with('error-login', 'Username dan Password salah');
		}
	}

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
